<?php

/* This file is part of the Markdownify 3 project, which is under MIT license */

namespace Markdownify;

use \Markdownify\NodeConverter\RootNodeConverter;

class Converter
{


    /* ATTRIBUTES
     *************************************************************************/
    protected $rootNode = null;
    protected $options;


    /* CONSTRUCTOR METHODS
     *************************************************************************/
    public function __construct($options = array())
    {
        // TODO: options, include Extra converter
    }


    /* PUBLIC METHODS
     *************************************************************************/
    public function load($html)
    {
        $document = new \DOMDocument();
        $document->loadHTML($html);
        $this->rootNode = (new RootNodeConverter($this))->loadDocument($document);
        return $this;
    }

    public function loadFile($file)
    {
        return $this->load(file_get_contents($file));
    }

    public function save()
    {
        return $this->rootNode->save($this->getNodeConverterClassList());
    }


    /* PUBLIC METHODS
     *************************************************************************/
    public function getNodeConverterClassList()
    {
        return array(
            'ParagraphNodeConverter',
            'TextNodeConverter',
            'HeaderNodeConverter',
            'TransparentNodeConverter'
        );
    }
}
