<?php

class autocompleteHelper {
    public static function executeAutocomplete($action, $request, $model, $id = null, $name = 'name')
    {
        $alias = strtolower($model[0]);
        $action->getResponse()->setContentType('application/json');

        $results = Doctrine_Query::create()
            ->select("$alias.name")
            ->from("$model $alias")
            ->where("$alias.name LIKE ?", array($request->getParameter('q').'%'))
            ->limit($request->getParameter('limit'))
            ->orderBy("$alias.name")
            ->execute(array(), Doctrine::HYDRATE_ARRAY);

        $values = array();
        if (is_null($id)) {
            $id = strtolower($model).'_id';
        }
        foreach ($results as $result) {
            $values[$result[$id]] = $result['name'];
        }

        return $action->renderText(json_encode($values));
    }
}
