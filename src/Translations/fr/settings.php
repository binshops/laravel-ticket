<?php

/*
 * Setting descriptions
 *
 * See Seeds/SettingsTableSeeder.php
 */

$codemirrorVersion = Binshops\LaravelTicket\Helpers\Cdn::CodeMirror;
$summernoteVersion = Binshops\LaravelTicket\Helpers\Cdn::Summernote;

return [

    'status_notification' => <<<'ENDHTML'
			<p>
				<b>notification sur le statut</b>: envoyer des notifications par mel aux propriétaires et gestionnaires du ticket quand son statut change
			</p>

			<p>
				Par défaut, envoi de notifications: <code>1</code><br>
				Ne pas envoyer de notifications: <code>0</code>
			</p>
ENDHTML

    , 'comment_notification' => <<<'ENDHTML'
			<p>
				<b>notification sur le commentaire</b>: Envoyer une notification quand un nouveau commentaire est publié
			</p>

			<p>
				Par défaut, envoi de notifications: <code>1</code><br>
                                Ne pas envoyer de notifications: <code>0</code>
			</p>
ENDHTML

];
