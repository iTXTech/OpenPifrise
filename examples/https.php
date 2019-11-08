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

/*
 * cert.crt and private.key must exist
 */

require_once "env.php";

use iTXTech\Rpf\Launcher;
use iTXTech\SimpleFramework\Console\Logger;

Logger::info("Constructing");
$launcher = (new Launcher())
	->listen("127.0.0.1", 443, true)
	->listen("127.0.0.1", 80)
	->ssl("cert.crt", "private.key")
	->verify(true)
	->handler(new DefaultHandler());

load($launcher);
