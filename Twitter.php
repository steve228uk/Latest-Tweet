<?php
/**
 * @plugin Latest Tweet
 * @author Cocoon Design
 * @authorURI http://www.wearecocoon.co.uk/
 * @description Use the {{twitter}} shorttag to add the latest tweets
 * @copyright 2012 (C) Cocoon Design  
 */
 
 class Twitter {
 	public static function install(){
 		
 		# todo: only allow install to run once!
 		
 		$dbh = new CandyDB();
 		$dbh->exec("INSERT INTO ". DB_PREFIX ."options (option_key, option_value) VALUES ('twitteraccount', 'steve228uk')");
 		$dbh->exec("INSERT INTO ". DB_PREFIX ."options (option_key, option_value) VALUES ('tweetnumber', '3')");
 		
 	}
 	
 	public static function adminSettings(){
 		
 		$twitter = self::twitterAccount();
 		$number = self::tweetNumber();
 		
 		$html = "<ul>";
 		$html .= "<li>";
 		$html .= "<label>Twitter Account</label>";
 		$html .= "<input type='text' name='twitteraccount' value='$twitter'/>";
 		$html .= "</li>";
 		$html .= "<li>";
 		$html .= "<label>Number of Tweets</label>";
 		$html .= "<input type='text' name='tweetnumber' value='$twitter'/>";
 		$html .= "</li>";
 		$html .= "</ul>";
 		
 		return $html;
 	}
 	
 	public static function saveSettings(){
 		$account = $_POST['twitteraccount'];
 		
 		$dbh = new CandyDB();
 		$dbh->exec('UPDATE '. DB_PREFIX .'options SET option_value="'. $account .'" WHERE option_key="twitteraccount"');
 		
 	}
 	
 	public static function twitterAccount(){
 	
 		$dbh = new CandyDB();
 		$sth = $dbh->prepare('SELECT option_value FROM '. DB_PREFIX .'options WHERE option_key = "twitteraccount"');
 		$sth->execute();
 		
 		return $sth->fetchColumn();
 	
 	}
 	
 	public static function tweetNumber(){
 		
 		$dbh = new CandyDB();
 		$sth = $dbh->prepare('SELECT option_value FROM '. DB_PREFIX .'options WHERE option_key = "tweetnumber"');
 		$sth->execute();
 		
 		return $sth->fetchColumn();
 		
 	}
 	
 	public static function addShorttag(){
 		
 		ob_start();
 		include 'include.php';
 		$html = ob_get_clean();
 		
 		return array('{{twitter}}' => $html);
 		
 	}
 }