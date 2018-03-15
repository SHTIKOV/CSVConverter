<?php

namespace IronTanks\CoreBundle\CommonClasses;

use Symfony\Component\HttpFoundation\Response;

/**
 * ConvertCSV
 *
 * @author SHTIKOV
 */
class ConvertCSV {

    public $output = "";

    private $data = [];

    private $header = [];

    private $title = "";

    private $fileName = "";

    private $charset = "";

    public function __construct (string $delimiter = ';') {
        $this->delimiter = $delimiter;
    }

    /**
     *
     * @param string $fileName
     */
    public function setFileName (string $fileName) {
        $this->fileName = $fileName;
    }

    /**
     *
     * @param string $charset
     */
    public function setCharset (string $charset) {
        $this->charset = $charset;
    }

    /**
     *
     * @param array $data
     */
    public function setContent (array $data) {
        $this->data = $data;
    }

    /**
     *
     * @param array $header
     */
    public function setHeader (array $header) {
        $this->header = $header;
    }

    /**
     *
     * @param string $title
     */
    public function setTitle (string $title) {
        $this->title = $title;
    }

    /**
     *
     * @param bool $ifHeader
     * @return string
     */
    public function convert (bool $ifHeader = false) {
        $content = "";
        if ($ifHeader) {
            $headerArr = [];
        }

        foreach ($this->data as $obj) {
            foreach ($obj as $fieldName => $fieldValue) {
                if ($ifHeader) {
                    $headerArr[$fieldName] = $fieldName;
                }
                $content .= $fieldValue.$this->delimiter." ";
            }

            $content .= " \r\n";
        }

        if (count ($this->header)) {
            $header = implode ($this->delimiter , $this->header);
            $this->output = $this->title . " \r\n" . $header . " \r\n" . $content;
        } else if ($ifHeader) {
            $header = implode ($this->delimiter , $headerArr);
            $this->output = $this->title . " \r\n" . $header . " \r\n" . $content;
        } else {
            $this->output = $this->title . " \r\n" . $content;
        }
    }

    /**
     *
     * @return string
     */
    public function fetch () {
        return $this->output;
    }

    /**
     *
     * @return Symfony\Component\HttpFoundation\Response
     */
    public function getDownloadFile () {
        /* @var $response \Symfony\Component\HttpFoundation\Response */
        $response = new Response ($this->output);
        $response->headers->set ('Content-Type', 'text/csv');
        $response->headers->set('Content-Disposition', 'attachment; filename="'.$this->fileName.'.csv"');

        if ($this->charset) {
            $response->setCharset ($this->charset);
        } else {
            $response->setCharset ('utf-8');
        }

        return $response;
    }

}
