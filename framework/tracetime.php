<?php
class TraceTime {
	private $time_start;
	function Start()
	{
		$this->time_start = microtime(true);
	}
	
	function End($msg)
	{
		$time_end = microtime(true);
		$time = round(($time_end - $this->time_start) * 1000);

		error_log("$msg:$time msec秒かかりました\n", 3, APP_BASE_DIR. "log/" .session_id()."_trace.log");
	}
}

?>
