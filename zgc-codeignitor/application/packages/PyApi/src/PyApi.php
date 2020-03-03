<?php
namespace AmmadKhalid\Cli;

use AmmadKhalid\Cli\Api;
use Symfony\Component\Process\Process;

class PyApi extends Api
{

	/**
	 * @param $command
	 *
	 * @return string
	 */
	public function run($command)
	{
		$process = new Process($command);
		$process->mustRun();

		return $process->getOutput();
	}

	/**
	 * @param $command
	 *
	 * @return int
	 */
	public function runInBg($command)
	{
		$process = new Process($command);

		return $process->run();
	}

}