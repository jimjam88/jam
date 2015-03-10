<?php

namespace Jam\Common\Mvc;

use Phalcon\Http\Response;

class FauxResponse extends Response
{
    /**
     * Mock the send method.
     *
     * @return self
     */
    public function send()
    {
        $this->_sent = true;

        return $this;
    }

    /**
     * Mock the send headers method.
     *
     * @return self
     */
    public function sendHeaders()
    {
        return $this;
    }

    /**
     * JSON content setter.
     *
     * @param  array $json The JSON
     * @param  long  $args The encoder args
     * @return self
     */
    public function setJsonContent($json, $args = JSON_NUMERIC_CHECK)
    {
        $encoded = json_encode($json, $args);

        $this->setContent(json_decode($encoded));

        return $this;
    }
}
