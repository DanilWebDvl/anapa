<?
namespace Module\Project;

abstract class Basis {
    protected $module_id = 'module.project';
    protected $errors;

    protected function addError($string) {
        $this->errors[] = $string;
    }

    protected function showErrors() {
        if (!empty($this->errors)) {
            $errosStr = '';
            foreach ($this->errors as $error) {
                $errosStr .= $error."; \n ";
            }
            $this->submitAlert($errosStr);
            throw new \Exception($errosStr);
        }
    }

    protected function submitAlert($string) {
        \CEventLog::Add(array(
            "SEVERITY" => "INFO",
            "AUDIT_TYPE_ID" => "ERROR_IN_PARSER",
            "MODULE_ID" => "module.project",
            "DESCRIPTION" => $string,
        ));

        \CEvent::Send("ERROR_IN_PARSER", "s1", ["TEXT" => $string]);
    }

    /**
     * @return bool
     */
    protected function hasError() {
        return !empty($this->errors);
    }
}
?>