<?php
require __DIR__.'/vendor/autoload.php';
require __DIR__.'/config.php';

if (PHP_SAPI === 'cli') parse_str(implode('&', array_slice($argv, 1)), $_GET);
$action = @$_GET['a'];

echo 'Follow Following Instagram - Version 0.1.0' . PHP_EOL;
echo 'By: Nabi KaramAliZadeh <www.nabi.ir> <nabikaz@gmail.com>' . PHP_EOL;
echo 'Project: https://github.com/NabiKAZ/Follow-Following-Instagram' . PHP_EOL;
echo 'Copyright 2020 - License GNU GPL v3.0' . PHP_EOL;
echo '==============================================================' . PHP_EOL;
echo PHP_EOL;

if (!$action || ($action != 'follow' && $action != 'unfollow')) {
	echo 'Usage:' . PHP_EOL;
	echo '   php follow.php [OPTIONS]' . PHP_EOL;
	echo PHP_EOL;
	echo 'Options:' . PHP_EOL;
	echo '   a = action (Values: follow,unfollow) (Required)' . PHP_EOL;
	echo PHP_EOL;
	echo 'Examples:' . PHP_EOL;
	echo '   php follow.php a=follow' . PHP_EOL;
	echo '   php follow.php a=unfollow' . PHP_EOL;
	die;
}

$ig = new \InstagramAPI\Instagram($debug, $truncated_debug, [
    'storage' => 'file',
    'basefolder' => $base_folder,
]);

try {
    $loginResponse = $ig->login($username, $password);
    if ($loginResponse !== null && $loginResponse->isTwoFactorRequired()) {
        $two_factor_identifier = $loginResponse->getTwoFactorInfo()->getTwoFactorIdentifier();
		echo "input sms code: ";
        $verification_code = trim(fgets(STDIN));
        $ig->finishTwoFactorLogin($verification_code, $two_factor_identifier);
    }
} catch (\Exception $e) {
    echo 'Something went wrong: '.$e->getMessage()."\n";
    exit(0);
}

try {
	
	if ($action == 'follow') {
		echo 'Getting self (' . $username . ') following...' . PHP_EOL;
		$rank_token = \InstagramAPI\Signatures::generateUUID();
		$max_id = null;
		$my_following = [];
		do {
			$response = $ig->people->getSelfFollowing($rank_token, null, $max_id);
			foreach ($response->getUsers() as $user) {
				$my_following[$user->getPk()] = $user->getUsername();
			}
			$max_id = $response->getNextMaxId();
			echo '.';
			sleep(1);
		} while ($max_id !== null);
		echo PHP_EOL;
		echo 'Found ' . count($my_following) . ' users.' . PHP_EOL;
		echo PHP_EOL;
		
		echo 'Starting follow following of target page (' . $target_page . ')...' . PHP_EOL;
		$user_id = $ig->people->getUserIdForName($target_page);
		$rank_token = \InstagramAPI\Signatures::generateUUID();
		$max_id = null;
		$page = 1;
		$followed_count = 0;
		$following_count = 0;
		do {
			echo 'Page #' . $page . PHP_EOL;
			$response = $ig->people->getFollowing($user_id, $rank_token, null, $max_id);
			foreach ($response->getUsers() as $user) {
				echo str_pad($user->getPk(), 11) . ' : ' . str_pad($user->getUsername(), 25);
				if (isset($my_following[$user->getPk()])) {
					echo 'Followed.' . PHP_EOL;
					$followed_count++;
				} else {
					echo 'Following...';
					$ig->people->follow($user->getPk());
					file_put_contents($users_file, $user->getPk() . "\t" . $user->getUsername() . PHP_EOL, FILE_APPEND);
					echo 'Done.' . PHP_EOL;
					$following_count++;
					sleep(1);
				}
				//if (@++$n>=3) break;//for debug
			}
			$max_id = $response->getNextMaxId();
			$page++;
		} while ($max_id !== null);
		
		echo PHP_EOL;
		echo 'Followed count: ' . $followed_count . PHP_EOL;
		echo 'New following count: ' . $following_count . PHP_EOL;
	
	} elseif ($action == 'unfollow') {
		$users_content = file_get_contents($users_file);
		$users = explode(PHP_EOL, $users_content);
		$users = array_filter($users);
		if (count($users) == 0) {
			echo 'Not found any user for unfollow.' . PHP_EOL;
		}
		foreach ($users as $user) {
			list($user_id, $username) = explode("\t", $user);
			echo str_pad($user_id, 11) . ' : ' . str_pad($username, 25);
			echo 'Unfollowing...';
			$ig->people->unfollow($user_id);
			$users_content = str_replace($user_id . "\t" . $username . PHP_EOL, '', $users_content);
			echo 'Done.' . PHP_EOL;
		}
		file_put_contents($users_file, $users_content);
	}
	
} catch (\Exception $e) {
    echo 'Something went wrong: '.$e->getMessage()."\n";
}
