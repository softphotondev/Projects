<?php
namespace AmmadKhalid\Cli;


class Api
{
	/**
	 * @var string
	 */
	private $interpreter;
	/**
	 * @var string
	 */
	private $program;
	/**
	 * @var string
	 */
	protected $cli;
	/**
	 * @var array
	 */
	protected $arguments = [];
	/**
	 * @var array
	 */
	protected $positionalArguments = [];
	/**
	 * Argument Dashes.
	 * @var string
	 */
	protected $dashes = "--";

	/**
	 * Positional Argument Dashes.
	 * @var string
	 */
	protected $positionalArgumentDashes = null;

	/**
	 * Api constructor.
	 *
	 * @param string $interpreter
	 * @param string $program
	 */
	public function __construct($interpreter, $program)
	{
		$this->interpreter = $interpreter;
		$this->program = $program;
	}

	/**
	 * @param string $dash
	 *
	 * @return \AmmadKhalid\ExecPy\Api
	 */
	public function setArgumentDashes($dash)
	{
		$this->dashes = $dash;

		return $this;
	}


	/**
	 * @param $dash
	 *
	 * @return \AmmadKhalid\ExecPy\Api
	 */
	public function setPositionalArgumentDashes($dash)
	{
		$this->positionalArgumentDashes = $dash;

		return $this;
	}

	/**
	 * @param string|array $argument
	 * @param null $value
	 *
	 * @return $this
	 */
	public function addArgument($argument, $value = null)
	{
		if(gettype($argument) != "array")
		{
			$argument = [$argument  =>  $value];
		}

		$this->arguments = array_merge($this->arguments, $argument);

		return $this;
	}

	/**
	 * @param  string  $program
	 * @param bool $removeDuplicates
	 *
	 * @return string
	 */
	protected function generateShellExec($program, $removeDuplicates = true)
	{
		if($removeDuplicates) {
			/**
			 * Remove all duplicates.
			 */
			$this->positionalArguments = array_unique($this->positionalArguments);
			$this->arguments = array_unique($this->arguments, SORT_REGULAR);
		}

		/**
		 * Apply Program.
		 *
		 * E.g: python main.py or test
		 *
		 */
		$this->cli = $program." ";

		/**
		 * add positional arguments first.
		 */
		foreach ($this->positionalArguments as $arg) {
			$this->cli .= $this->positionalArgumentDashes.$arg." ";
		}

		/**
		 * add positional arguments first.
		 */
		foreach ($this->arguments as $arg => $value) {
			$value = escapeshellarg($value);

			$this->cli .= $this->dashes.$arg." ".$value." ";
		}

		return $this->cli;
	}

	/**
	 * @param bool $removeDuplicates
	 *
	 * @return string
	 */
	public function getProgramCommand($removeDuplicates = false) {
		return $this->generateShellExec($this->program, $removeDuplicates);
	}

	/**
	 * @param bool $removeDuplicates
	 *
	 * @return string
	 */
	public function getCommand($removeDuplicates = false)
	{
		return $this->generateShellExec($this->interpreter." ".$this->program, $removeDuplicates);
	}

	/**
	 * @param $name
	 *
	 * @return $this
	 */
	public function addPositionalArgument($name)
	{
		$this->positionalArguments[] = $name;

		return $this;
	}


}