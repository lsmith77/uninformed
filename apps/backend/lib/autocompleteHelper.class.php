<?php

class autocompleteHelper {
    public static function executeAutocomplete($action, $request, $model, $id = null, $name = 'name')
    {
        $action->getResponse()->setContentType('application/json');

        if (!$model::checkAutoComplete($model, $name)) {
            return $action->renderText(json_encode(false));
        }

        $alias = strtolower($model[0]);
        $limit = (int)$request->getParameter('limit', 10);
        $q = $request->getParameter('q');

        $results = Doctrine_Query::create()
            ->select("$alias.$name")
            ->from("$model $alias")
            ->where("$alias.$name LIKE ?", array($q.'%'))
            ->limit($limit)
            ->orderBy("$alias.$name")
            ->execute(array(), Doctrine::HYDRATE_ARRAY);

        $values = array();
        if (is_null($id)) {
            $id = strtolower($model).'_id';
        }
        foreach ($results as $result) {
            $values[$result[$id]] = $result[$name];
        }

        return $action->renderText(json_encode($values));
    }
}
