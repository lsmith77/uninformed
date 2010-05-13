<?php

abstract class MyBaseRecord extends sfDoctrineRecord
{
  protected static $autoCompletable = array();
  protected $overloadProperty = null;

  public static function checkAutoComplete($property) {
    return !empty(static::$autoCompletable[$property]);
  }

  public function __toString() {
    $string = parent::__toString();
    if (strlen($string) > 100) {
        $string = substr($string, 0, 100).' ..';
    }
    return $string;
  }

    protected function convertTags2Ids($tags)
    {
        if (is_string($tags)) {
            $sep = strpos($tags, ',') !== false ? ',' : ' ';
            $tagNames = explode($sep, $tags);
            $newTagNames = array();
            foreach ($tagNames as $key => $tagName) {
                $tagName = trim($tagName);
                if ($tagName) {
                    $newTagNames[$tagName] = true;
                }
            }

            $tagsList = array();
            if ( ! empty($tagNames)) {
                $existingTags = Doctrine_Query::create()
                    ->from('Tag t')
                    ->whereIn('t.name', array_keys($newTagNames))
                    ->fetchArray();

                foreach ($existingTags as $tag) {
                    $tagsList[] = $tag['id'];
                    unset($newTagNames[$tag['name']]);
                }

                foreach ($newTagNames as $tagName => $foo) {
                    $tag = new Tag();
                    $tag->name = $tagName;
                    $tag->save();
                    $tagsList[] = $tag['id'];
                }
            }

            return $tagsList;
        } else if (is_array($tags)) {
            if (is_numeric(current($tags))) {
                return $tags;
            } else {
                return $this->convertTags2Ids(implode(', ', $tags));
            }
        } else if ($tags instanceof Doctrine_Collection) {
            return $tags->getPrimaryKeys();
        }

        throw new Doctrine_Exception('Invalid $tags data provided. Must be a string of tags, an array of tag ids, or a Doctrine_Collection of tag records.');
    }

    public function setTags($tags)
    {
        // TODO: only allow for ClauseBody/Document
        $tagIds = $this->convertTags2Ids($tags);
        $this->unlink('Tags');
        $this->link('Tags', $tagIds);
    }

    public function getTagIds() {
        // TODO: only allow for ClauseBody/Document
        $colname = preg_replace('/([A-Z])/', '_$1', lcfirst(get_class($this)));
        $colname = strtolower($colname);
        $ids = Doctrine_Query::create()
            ->select('tag_id')
            ->from(get_class($this).'Tag')
            ->where($colname.'_id = ?', $this->_get('id'))
            ->execute(array(), Doctrine_Core::HYDRATE_SCALAR);
        foreach ($ids as $key => $id) {
            $ids[$key] = reset($id);
        }
        return $ids;
    }

    public function hasComments()
    {
      return $this->getNbComments() > 0;
    }

    public function getNbComments()
    {
      return $this->getCommentsQuery()->count();
    }

    public function addComment(Comment $comment)
    {
      $comment->set('record_model', $this->getTable()->getComponentName());
      $comment->set('record_id', $this->get('id'));
      $comment->save();

      return $this;
    }

    public function getAllComments()
    {
      return $this->getCommentsQuery()->execute();
    }

    public function getCommentsQuery()
    {
      return Doctrine::getTable('Comment')->createQuery('c')
        ->innerJoin( 'c.User u')
        ->innerJoin( 'c.CommentReport cr')
        ->where('c.record_id = ?', $this->get('id'))
        ->andWhere('c.record_model = ?', $this->getTable()->getComponentName())
        ->andWhere('cr.state = ?', 'invalid')
        ->orderBy('c.created_at ASC');
    }

    public function __call($method, $params) {
        try {
            return parent::__call($method, $params);
        } catch (Exception $e) {}

        if ($this->overloadProperty) {
            $overloadProperty = $this->_get($this->overloadProperty);
        }

        if (empty($overloadProperty) || !is_object($overloadProperty)) {
            throw new Exception(sprintf('Call to undefined function: %s::%s().', get_class($this), $method), E_USER_ERROR);
        }

        return call_user_func_array(array($overloadProperty, $method), $params);
    }

}
