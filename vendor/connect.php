<?php

		$connect = mysqli_connect('localhost', 'root', '', 'autho_and_registr');

		if (!$connect) {
			die('Error connect to data base');
		}