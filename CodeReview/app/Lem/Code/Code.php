<?php namespace Lem\Code;

use App\Facades\User;

/**
 * to manipilate the pages
 **/
class Code
{
    protected $variables = [];
    protected $prefix = '#';

    function __construct()
    {
        if(\Auth::check())
            $this->variables['current_user_id'] = User::getCurrentUser()->id;
    }


    /**
     * execute a code
     *
     * @param  string  $code
     * @return mixed
     */
    public function execute($code, $variables=[])
    {
        foreach ($variables as $key => $value) {
            $code = $this->replaceVariableWithItsValue($code, $key, $value);
        }

        foreach ($this->variables as $key => $value) {
            $code = $this->replaceVariableWithItsValue($code, $key, $value);
        }

        $code = $this->replaceVariableWithItsValue($code, "diaz", "#");
        return eval($code);
   }


    /**
     * replace a variable with its Value
     *
     * @param  string  $code
     * @return string
     */
    private function replaceVariableWithItsValue($code, $variable, $value)
    {
        return str_replace($this->prefix.$variable, $value, $code);
    }


}
