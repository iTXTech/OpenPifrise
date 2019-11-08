<?php

/*
 *
 * iTXTech Rpf
 *
 * Copyright (C) 2018-2019 iTX Technologies
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 *
 */

namespace iTXTech\Rpf;

use iTXTech\SimpleFramework\Console\Logger;
use iTXTech\SimpleFramework\Console\SwooleLoggerHandler;
use iTXTech\SimpleFramework\Module\Module;

class Loader extends Module{
	/** @var Loader */
	private static $instance;
	/** @var Rpf[] */
	private $instances = [];

	public function preLoad() : bool{
		self::$instance = $this;
		return parent::preLoad();
	}

	public function load(){
		SwooleLoggerHandler::init();
		Logger::setLoggerHandler(SwooleLoggerHandler::class);
	}

	public function unload(){
		foreach($this->instances as $instance){
			$instance->shutdown();
		}
		SwooleLoggerHandler::shutdown();
	}

	public static function getInstance() : ?Loader{
		return self::$instance;
	}

	public function addInstance(Rpf $rpf){
		$this->instances[spl_object_hash($rpf)] = $rpf;
	}

	public function removeInstance(Rpf $rpf){
		unset($this->instances[spl_object_hash($rpf)]);
	}
}
