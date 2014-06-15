<?php
if (!defined("IN_ESOTALK")) exit;

ET::$pluginInfo["Minotar"] = array(
	"name" => "Minotar",
	"description" => "Use Minecraft avatars as your profile picture.",
	"version" => "0.1",
	"author" => "charries96",
	"authorEmail" => "connorsharries96@gmail.com",
	"authorURL" => "http://github.com/charries96",
	"license" => "MIT"
);

class ETPlugin_Minotar extends ETPlugin {
	function init()
	{
		function avatar($member = array(), $className = "", $size = 64)
		{
			$default = C("plugin.Minotar.default") ? C("plugin.Minotar.default") : "mm";

			$protocol = C("esoTalk.https") ? "https" : "http";
			$url = "$protocol://minotar.net/helm/".trim($member["username"])."/$size";

			return '<img src="'.$url.'" alt="'.$member['username'].'\'s avatar." class="avatar'.($className !== "" ? " ".$className : "").'"/>';
		}
	}

	function handler_settingsController_initGeneral($sender, $form)
	{
		$form->removeField("avatar", "avatar");
		$form->addField("avatar", "avatar", array($this, "fieldAvatar"));
	}

	function fieldAvatar($form)
	{
		return sprintf(T("Change your avatar on %s."), "<a href='https://minecraft.net/profile' target='_blank'>Minecraft.net</a>");
	}
}
