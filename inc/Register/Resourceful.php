<?php

namespace MuseumCore\Register;

use MuseumCore\Util\Inflector;

trait Resourceful
{
    protected $modelClass = null;
    protected $controllerClass = null;
    protected $templates = null;

    /**
     * Set the Registrable ID for WordPress to use. Don't use reserved names.
     *
     * @param string $id set the ID
     * @param boolean $resource update the resource binding
     *
     * @return $this
     */
    public function setId($id, $resource = false)
    {
        $this->id = str_replace(' ', '_', $id);
        $this->dieIfReserved();

        if($resource) {
            $singular     = str_replace(' ', '_', $this->id );
            $plural       = str_replace(' ', '_', Inflector::pluralize($this->id) );
            $this->resource = [$singular, $plural, $this->modelClass, $this->controllerClass];
        }

        return $this;
    }

    /**
     * Set the Registrable ID for WordPress to use. Don't use reserved names.
     *
     * @param string $id set the ID in raw form
     * @param boolean $resource update the resource binding
     *
     * @return $this
     */
    public function setRawId($id, $resource = false)
    {
        $this->id = $id;
        $this->dieIfReserved();

        if($resource) {
            $singular     = $this->id;
            $plural       = Inflector::pluralize($this->id);
            $this->resource = [$singular, $plural, $this->modelClass, $this->controllerClass];
        }

        return $this;
    }

    /**
     * Override Default Controller and Model
     *
     * @param string $controller_class
     * @param string|null $model_class
     * @return $this
     */
    public function setHandler($controller_class, $model_class = null)
    {
        $this->modelClass = $model_class;
        $this->controllerClass = $controller_class;
        $this->resource[2] = $this->modelClass;
        $this->resource[3] = $this->controllerClass;

        return $this;
    }

    /**
     * Set Templates
     *
     * @param array $templates
     * @return $this
     */
    public function setTemplates($templates)
    {
        $this->templates = $templates;

        return $this;
    }

    /**
     * Get Templates
     *
     * @return null
     */
    public function getTemplates()
    {
        return $this->templates;
    }
}
