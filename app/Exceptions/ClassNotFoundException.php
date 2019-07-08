<?php


namespace App\Exceptions;

use Exception;
use Illuminate\Support\Facades\Log;

class ClassNotFoundException extends Exception
{
    private $classname;

    /**
     * @param string $classname
     */
    public function __construct($classname, $message = '', $code = 0, Exception $previous = null)
    {
        $this->classname = $classname;
        if (!$message) {
            $message = "Class {$this->classname} not found!";
        }

        parent::__construct($message, $code, $previous);
    }

    public function getLogMessage()
    {
        if(isset($this->logMessage)) {
            return $this->logMessage;
        }
        return $this->getMessage();
    }

    public function report()
    {
        Log::error($this->getLogMessage());
    }

    public function render($request)
    {
        if($request->ajax()) {
            return response()->json(['status' => 'error', 'message' => $this->getMessage(), 'code' => $this->getCode()]);
        }

        $request->session()->flash('notification', [
            'title' => 'Error',
            'message' => $this->getMessage()
        ]);

        return redirect()->back();
    }
}