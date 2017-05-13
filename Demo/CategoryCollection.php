<?php

namespace Demo;


use PWE\Core\PWECore;
use PWE\Exceptions\HTTP2xxException;
use PWE\Exceptions\HTTP4xxException;

class CategoryCollection extends AbstractCollection
{

    public function __construct(PWECore $core)
    {
        parent::__construct($core);
    }

    public function handleGet($item = null)
    {
        if ($item) {
            $items = $this->getItemByID(round($item));
            if (!$items) {
                throw new HTTP4xxException("Category not found", HTTP4xxException::NOT_FOUND);
            }
            return $items[0];
        } else {
            return $this->getItems();
        }
    }

    protected function handlePost($data)
    {
        if (!$this->context->isLoggedIn()) {
            throw new HTTP4xxException("You need to be authenticated to add items", HTTP4xxException::FORBIDDEN);
        }

        $items=$this->getItems();
        foreach ($items as $item) {
            if ($item['name']==$data['name']) {
                throw new HTTP4xxException("Cannot add category, same name already exists");
            }
        }

        $new = $this->context->addCategory($data);
        $this->PWE->sendHTTPStatusCode(HTTP2xxException::CREATED);
        return $this->handleGet($new);
    }


    private function getItems()
    {
        return $this->context->getCategories();
    }

    private function getItemByID($id)
    {
        $items = $this->getItems();
        foreach ($items as $item) {
            if ($item['id'] == $id) {
                return [$item];
            }
        }
        throw new HTTP4xxException("Item not found", HTTP4xxException::NOT_FOUND);
    }

}