<?php
//======================================================================\\
// Author: Anthony Kuypers			                                    \\
// Website: http://pricop.info									        \\
// Email: pricop2008@yahoo.com											\\
// Updated: 8/28/2013 [MM/DD/YYYY]										\\
// Language: Dutch												    	\\
//======================================================================\\

// Character encoding
$LNG['charset'] = "iso-8859-1";

$LNG['user_success'] = 'Gebruiker succesvol aangemaakt!';
$LNG['user_exists'] = 'Deze gebruikersnaam bestaat reeds.';
$LNG['email_exists'] = 'Dit e-mailadres is al in gebruik.';
$LNG['all_fields'] = 'Alle velden zijn verplicht!';
$LNG['user_alnum'] = 'De gebruikersnaam mag alleen bestaan uit letters en cijfers.';
$LNG['user_too_short'] = 'De gebruikersnaam moet tussen de 3 en 32 tekens zijn.';
$LNG['invalid_email'] = 'Ongeldig e-mailadres!';
$LNG['invalid_user_pw'] = 'Ongeldige gebruikersnaam of wachtwoord.';
$LNG['invalid_captcha'] = 'ongeldige captcha';
$LNG['log_out'] = 'Afmelden';
$LNG['hello'] = 'Hallo';
$LNG['visitor'] = 'Bezoeker';
$LNG['register'] = 'Registreren';
$LNG['login'] = 'Inloggen';
$LNG['password'] = 'Wachtwoord';
$LNG['username'] = 'Gebruikersnaam';
$LNG['username_or_email'] = 'Gebruikersnaam of email';
$LNG['email'] = 'Email';
$LNG['captcha'] = 'Captcha';
$LNG['welcome_title'] = 'Welkom';
$LNG['welcome_desc'] = 'op ons sociale netwerk';
$LNG['welcome_about'] = 'deel je herinneringen, contact met anderen, maak nieuwe vrienden.';
$LNG['forgot_password'] = 'Wachtwoord vergeten?';
$LNG['all_rights_reserved'] = 'Alle rechten voorbehouden';

// NOTIFICATION BOXES //
$LNG['settings_saved'] = 'Instellingen opgeslagen';
$LNG['nothing_saved'] = 'Niets opgeslagen';
$LNG['general_settings_saved'] = 'Algemene instellingen succesvol opgeslagen.';
$LNG['overall_settings_saved'] = 'Je instellingen zijn bijgewerkt';
$LNG['general_settings_unaffected'] = 'Geen veranderingen aangebracht.';
$LNG['password_changed'] = 'Wachtwoord gewijzigd';
$LNG['nothing_changed'] = 'Niets veranderd';
$LNG['password_success_changed'] = 'Wachtwoord succesvol gewijzigd, je kunt je nieuwe wachtwoord gebruiken.';
$LNG['incorrect_date'] = 'De geselecteerde datum is niet geldig.';
$LNG['password_not_changed'] = 'Je wachtwoord is niet veranderd.';
$LNG['image_saved'] = 'Afbeelding opgeslagen';
$LNG['profile_picture_saved'] = 'Je profielafbeelding is gewijzigd.';
$LNG['error'] = 'Fout';
$LNG['no_file'] = 'Je hebt geen bestanden geselecteerd om te uploaden, of het geselecteerde bestand(en) zijn leeg.';
$LNG['file_exceeded'] = 'Het geselecteerde bestand mag niet groter zijn dan <strong>%s</strong> MB.';
$LNG['file_format'] = 'Het geselecteerde bestand wordt niet ondersteund. Upload <strong>%s</strong> bestandsformaten';
$LNG['image_removed'] = 'Afbeelding verwijderd';
$LNG['profile_picture_removed'] = 'Je profielfoto is verwijderd.';
$LNG['bio_description'] = 'De Bio beschrijving moet %s tekens of minder zijn.';
$LNG['valid_email'] = 'Vul een geldig e-mailadres in';
$LNG['valid_url'] = 'Vul een geldige URL in';
$LNG['background_changed'] = 'De achtergrond is met succes gewijzigd.';
$LNG['background_not_changed'] = 'De achtergrond kan niet worden veranderd.';
$LNG['password_too_short'] = 'Het wachtwoord moet minimaal <strong>3</strong> karakters bevatten.';
$LNG['something_went_wrong'] = 'Er ging iets mis!';
$LNG['username_not_found'] = 'We konden de gekozen gebruikersnaam niet vinden.';
$LNG['userkey_not_found'] = 'De gebruikersnaam of de reset sleutel zijn verkeerd, zorg ervoor dat je de juiste gegevens hebt ingevoerd.';
$LNG['password_reseted'] = 'You have succcessfully reseted your passsword, you can now log-in using the new credentials.';
$LNG['email_sent'] = 'E-mail verzonden';
$LNG['email_reset'] = 'Een e-mail met reset sleutel is verstuurd. Controleer ook je spam box als als het bericht niet in de Postvak IN bevind.';
$LNG['user_deleted'] = 'Gebruiker verwijdert';
$LNG['user_has_been_deleted'] = 'Gebruiker met ID: <strong>%s</strong> is verwijderd.';
$LNG['user_not_deleted'] = 'De geselecteerde gebruiker (ID: %s) kon niet worden verwijderd.';
$LNG['user_not_exist'] = 'De geselecteerde gebruiker bestaat niet.';
$LNG['theme_changed'] = 'Theme veranderd';
$LNG['theme_success_changed'] = 'Het theme is met succes gewijzigd.';
$LNG['theme_not_changed'] = 'Sorry het theme kon niet worden veranderd';
$LNG['notif_saved'] = 'Meldingen veranderd';
$LNG['notif_success_saved'] = 'Meldingen zijn succesvol bijgewerkt.';

// MAIL CONTENT //
$LNG['welcome_mail'] = 'Welkom op %s';
$LNG['user_created'] = 'Dank je voor het aanmelden op <strong>%s</strong><br /><br />Je gebruikersnaam: <strong>%s</strong><br />Je wachtwoord: <strong>%s</strong><br /><br />Je kan inloggen op: <a href="%s" target="_blank">%s</a>';
$LNG['recover_mail'] = 'Wachtwoord herstel';
$LNG['recover_content'] = 'Een wachtwoord herstel is gevraagd, al je dit niet het aangevraagd kan je deze mail als niet verzonden beschouwen.<br /><br />Je gebruikersnaam: <strong>%s</strong><br />Je reset sleutel: <strong>%s</strong><br /><br />Je kunt je wachtwoord opnieuw instellen door op de volgende link te klikken: <a href="%s/index.php?a=recover&r=1" target="_blank">%s/index.php?a=recover&r=1</a>';
$LNG['ttl_comment_email'] = '%s gereageerd op je bericht';
$LNG['comment_email'] = 'Hallo <strong>%s</strong>,<br /><br /><strong><a href="%s">%s</a></strong> heeft gereageerd op je <strong><a href="%s">bericht.</a></strong>
<br /><br /><span style="color: #aaa;">Dit bericht is automatisch verzonden, als je niet wilt dat dit soort e-mails te ontvangen van <strong>%s</strong> in de toekomst klik <a href="%s">hier</a> voor uitschrijven.</span>';
$LNG['ttl_like_email'] = '%s vind je bericht leuk';
$LNG['like_email'] = 'Hallo <strong>%s</strong>,<br /><br /><strong><a href="%s">%s</a></strong> vind je <strong><a href="%s">bericht</a> leuk.</strong>
<br /><br /><span style="color: #aaa;">Dit bericht is automatisch verzonden, als je niet wilt dat dit soort e-mails te ontvangen van <strong>%s</strong> in de toekomst klik <a href="%s">hier</a> voor uitschrijven.</span>';
$LNG['ttl_new_friend_email'] = '%s Toevoegen als vriend';
$LNG['new_friend_email'] = 'Hello <strong>%s</strong>,<br /><br /><strong><a href="%s">%s</a></strong> heeft je als vriend toegevoegd.
<br /><br /><span style="color: #aaa;">Dit bericht is automatisch verzonden, als je niet wilt dat dit soort e-mails te ontvangen van <strong>%s</strong> in de toekomst klik <a href="%s">hier</a> voor uitschrijven.</span>';

// ADMIN PANEL //

$LNG['general_link'] = 'Algemeen';
$LNG['security_link'] = 'Veiligheid';
$LNG['manage_users'] = 'Gebruikers beheren';

$LNG['theme_install'] = 'Om een nieuw theme te installeren, uploaden de theme naar de <strong>themes</strong> folder.';
$LNG['theme_author_homepage'] = 'Bezoek de auteur homepage';
$LNG['theme_version'] = 'Versie';
$LNG['theme_active'] = 'Actief';
$LNG['theme_activate'] = 'Activeren';
$LNG['theme_by'] = 'Door';

// FEED //
$LNG['welcome_feed_ttl'] = 'Welkom op je Feed';
$LNG['welcome_feed'] = 'Alle berichten van je vrienden zullen verschijnen op deze pagina, beginnen met het maken van nieuwe vrienden.';
$LNG['welcome_timeline_ttl'] = 'Welkom op je Tijdlijn feed';
$LNG['welcome_timeline'] = 'Al uw berichten worden weergegeven op deze pagina, beginnen met het delen van je gedachten.';
$LNG['leave_comment'] = 'Plaats een reactie ...';
$LNG['post'] = 'Post';
$LNG['view_more_comments'] = 'Bekijk meer opmerkingen';
$LNG['this_post_private'] = 'Dit bericht is prive';
$LNG['this_post_public'] = 'Dit bericht is openbaar';
$LNG['delete_this_comment'] = 'Verwijder dit commentaar';
$LNG['delete_this_message'] = 'Verwijder dit bericht';
$LNG['report_this_message'] = 'Rapporteer dit bericht';
$LNG['report_this_comment'] = 'Rapporteer deze reactie';
$LNG['view_more_messages'] = 'Laad Meer';
$LNG['food'] = 'Ik heb bij <strong>%s</strong> gegeten';
$LNG['visited'] = 'Ik heb <strong>%s</strong> bezocht';
$LNG['played'] = 'Ik heb <strong>%s</strong> gespeeld';
$LNG['watched'] = 'Ik heb <strong>%s</strong> gekeken';
$LNG['listened'] = 'Ik heb <strong>%s</strong> beluistert';
$LNG['shared'] = 'Ik deel een <a href="%s"><strong>bericht</strong></a> van <a href="%s"><strong>%s</strong></a>.';
$LNG['form_title'] = 'Update je status';
$LNG['comment_wrong'] = 'Er is iets misgegaan, Vernieuw de pagina en probeer het opnieuw.';
$LNG['comment_too_long'] = 'Sorry, maar het maximum aantal karakters per reactie is <strong>%s</strong>.';
$LNG['comment_error'] = 'Sorry, we konden je reactie niet plaatsen, Vernieuw de pagina en probeer het opnieuw.';
$LNG['message_hidden'] = 'Sorry, maar dit bericht is prive, alleen de eigenaar kan het bericht zien.';
$LNG['message_hidden_ttl'] = 'Prive Bericht';
$LNG['login_to_lcs'] = 'Login om te delen, reactie te geven, of te Delen';
$LNG['comment'] = 'Reageren';
$LNG['share'] = 'Delen';
$LNG['shared_success'] = 'Het bericht is met succes gedeeld op je <a href="%s"><strong>tijdlijn</strong></a>.';
$LNG['no_shared'] = 'Sorry maar we konden het bericht niet delen, Vernieuw de pagina en probeer het opnieuw.';
$LNG['share_title'] = 'Deel dit bericht';
$LNG['share_desc'] = 'Weet je zeker dat je dit bericht wilt delen op je tijdlijn?';
$LNG['cancel'] = 'Annuleren';
$LNG['close'] = 'Sluiten';

// REPORT //
$LNG['1_not_exists'] = 'De gerapporteerde bericht bestaat niet.';
$LNG['0_not_exists'] = 'De gerapporteerde reactie bestaat niet.';
$LNG['1_already_reported'] = 'Dit bericht is al gemeld en het zal worden beoordeeld in de korte tijd, dank je.';
$LNG['0_already_reported'] = 'De reactie is al gemeld en het zal worden beoordeeld in de korte tijd, dank je.';
$LNG['1_is_safe'] = 'Dit bericht is gemarkeerd als <strong>veilig</strong> door een beheerder, dank je voor je feedack.';
$LNG['0_is_safe'] = 'De reactie is gemarkeerd als <strong>veilig</strong> door een beheerder, dank je voor je feedack.';
$LNG['1_report_added'] = 'het bericht is grapporteert, dank je voor je feedback.';
$LNG['0_report_added'] = 'De reactie is grapporteert, dank je voor je feedback.';
$LNG['1_report_error'] = 'Sorry, maar er is iets misgegaan met het melden van de bericht, Vernieuw de pagina en probeer het opnieuw.';
$LNG['0_report_error'] = 'Sorry, maar er is iets misgegaan met het melden van de reactie, Vernieuw de pagina en probeer het opnieuw.';
$LNG['1_is_deleted'] = 'Het bericht is verwijderd, dank je voor je feedback.';
$LNG['0_is_deleted'] = 'De reactie is verwijderd, dank je voor je feedback.';

// SIDEBAR //
$LNG['filter_events'] = 'Gebeurtenissen filter';
$LNG['archive'] = 'Archief';
$LNG['all_events'] = 'Alle gebeurtenissen';
$LNG['sidebar_map'] = 'Plaatsen';
$LNG['sidebar_food'] = 'Maaltijden';
$LNG['sidebar_visited'] = 'Bezoeken';
$LNG['sidebar_movie'] = 'Films';
$LNG['sidebar_game'] = 'Games';
$LNG['sidebar_picture'] = 'fotos';
$LNG['sidebar_video'] = 'Videos';
$LNG['sidebar_music'] = 'Muziek';
$LNG['sidebar_shared'] = 'Gedeeld';
$LNG['all_time'] = 'Alle tijd';
$LNG['subscriptions'] = 'Vrienden';
$LNG['subscribers'] = 'Hebben als vriend';
$LNG['welcome'] = 'Welkom';
$LNG['filter_gender'] = 'Filter Geslacht';
$LNG['sidebar_male'] = 'Man';
$LNG['sidebar_female'] = 'Vrouw';
$LNG['all_genders'] = 'Alle geslachten';
$LNG['online_friends'] = 'Online vrienden';
$LNG['sidebar_likes'] = 'Vind ik leuk';
$LNG['sidebar_comments'] = 'Commentaar';
$LNG['sidebar_friendships'] = 'Gedeeld';
$LNG['sidebar_chats'] = 'Chats';
$LNG['sidebar_suggestions'] = 'Vrienden Suggestie';
$LNG['sidebar_trending'] = 'Trending topics';
$LNG['sidebar_friends_activity'] = 'Vrienden Activiteit';

// MESSAGES / CHAT //
$LNG['lonely_here'] = 'Het is eenzaam hier, wat dacht je er van om wat vrienden te maken?';
$LNG['write_message'] = 'Schrijf een bericht ...';
$LNG['chat_too_long'] = 'Sorry, maar het maximum aantal karakters per chatbericht is <strong>%s</strong>.';
$LNG['blocked_by'] = 'Het bericht kon niet worden verzonden. <strong>%s</strong> heeft je geblokkeerd.';
$LNG['blocked_user'] = 'Het bericht kon niet worden verzonden. Je hebt <strong>%s</strong> geblokkeerd.';
$LNG['chat_self'] = 'Sorry, maar we kunnen chatberichten niet leveren aan jezelf.';
$LNG['chat_no_user'] = 'Je moet een gebruiker selecteren om te chatten.';
$LNG['view_more_conversations'] = 'Bekijk meer gesprekken';
$LNG['block'] = 'Blokkeren';
$LNG['unblock'] = 'Deblokkeren';
$LNG['conversation'] = 'Gesprek';
$LNG['start_conversation'] = 'Je kunt een gesprek beginnen kies een persoon uit de vriendenlijst.';
$LNG['send_message'] = 'Zend Bericht';

// MESSAGE FORM //
$LNG['label_food'] = 'Voeg een plek toe waar je gegeten hebt';
$LNG['label_game'] = 'Voeg een gespeelde spel toe';
$LNG['label_movie'] = 'Voeg een bekeken film toe';
$LNG['label_visited'] = 'Voeg een bezochte locatie toe';
$LNG['label_map'] = 'Voeg een plek toe';
$LNG['label_video'] = 'Deel een videolink van YouTube of Vimeo';
$LNG['label_music'] = 'Deel een link van SoundCloud of voeg een beluisterd nummer toe';
$LNG['label_image'] = 'Upload Afbeeldingen';
$LNG['message_form'] = 'Wat ben je aan het doen?';
$LNG['file_too_big'] = 'Het geselecteerde bestand (%s) is te groot, de maximale toegestane bestandsgrootte is <strong>%s</strong>.';
$LNG['format_not_exist'] = 'Het geselecteerde bestand (%s) is ongeldig, upload slechts <strong>%s</strong> bestandsformaten.';
$LNG['privacy_no_exist'] = 'De geselecteerde privacy bestaat niet, Vernieuw de pagina en probeer het opnieuw.';
$LNG['event_not_exist'] = 'De geselecteerde gebeurtenis bestaat niet, Vernieuw de pagina en probeer het opnieuw.';

$LNG['unexpected_message'] = 'Er is een onverwachte fout opgetreden, Vernieuw de pagina en probeer het opnieuw.';
$LNG['message_too_long'] = 'Sorry, maar het maximum aantal karakters per bericht is <strong>%s</strong>.';
$LNG['files_selected'] = 'afbeeldig(en) geselecteerd.';
$LNG['too_many_images'] = 'Het maximale aantal afbeeldingen dat per bericht mag geüpload worden is <strong>%s</strong>, je probeerde <strong>%s</strong> te uploaden.';

// USER PANEL //
$LNG['user_menu_general'] = 'Algemeen';
$LNG['user_menu_security'] = 'Wachtwoord';
$LNG['user_menu_avatar'] = 'Profiel';
$LNG['user_menu_notifications'] = 'Meldingen';

$LNG['user_ttl_general'] = 'Algemene Instellingen';
$LNG['user_ttl_security'] = 'Wachtwoord Instellingen';
$LNG['user_ttl_avatar'] = 'Profiel Instellingen';
$LNG['user_ttl_notifications'] = 'Meldingen Instellingen';

$LNG['user_desc_general'] = 'Veranderen Profiel, privacy, locatie instellingen.';
$LNG['user_desc_security'] = 'Wijzig je wachtwoord.';
$LNG['user_desc_avatar'] = 'Wijzig je account Foto.';
$LNG['user_desc_cover'] = 'Wijzig je omslag foto.';
$LNG['user_desc_notifications'] = 'Wijzig je meldingen instellingen.';

$LNG['ttl_background'] = 'Achtergronden';
$LNG['sub_background'] = 'Kies een achtergrond voor uw profiel';

$LNG['ttl_first_name'] = 'Voornaam';
$LNG['sub_first_name'] = 'Geef je voornaam op';

$LNG['ttl_last_name'] = 'Achternaam';
$LNG['sub_last_name'] = 'Geef je achternaam op';

$LNG['ttl_email'] = 'Email';
$LNG['sub_email'] = 'E-mail wordt niet weergegeven';

$LNG['ttl_location'] = 'Plaats';
$LNG['sub_location'] = 'Waar woon je?';

$LNG['ttl_website'] = 'Website';
$LNG['sub_website'] = 'Als je een blog, persoonlijke pagina, hebt';

$LNG['ttl_gender'] = 'Geslacht';
$LNG['sub_gender'] = 'Selecteer uw geslacht (man of vrouw)';

$LNG['ttl_profile'] = 'Profiel';
$LNG['sub_profile'] = 'Profiel Privacy.';

$LNG['ttl_messages'] = 'Bericht Privacy';
$LNG['sub_messages'] = 'De standaard manier van het plaatsen van berichten';

$LNG['ttl_offline'] = 'Chat Status';
$LNG['sub_offline'] = 'De zichtbaarheid status voor de Chat';

$LNG['ttl_facebook'] = 'Facebook';
$LNG['sub_facebook'] = 'Je facebook profiel ID.';

$LNG['ttl_twitter'] = 'Twitter';
$LNG['sub_twitter'] = 'Je twitter profiel ID.';

$LNG['ttl_google'] = 'Google+';
$LNG['sub_google'] = 'Je google+ profiel ID.';

$LNG['ttl_bio'] = 'Bio';
$LNG['sub_bio'] = 'Over je zelf (160 tekens of minder)';

$LNG['ttl_born'] = 'Geboortedatum';
$LNG['sub_born'] = 'Selecteer de datum waarop je geboren bent';

$LNG['ttl_not_verified'] = 'Niet geverifieerd';
$LNG['ttl_verified'] = 'geverifieerd';
$LNG['sub_verified'] = 'Geverifieerd badge op gebruikers profiel';

$LNG['ttl_upload_avatar'] = 'Het geselecteerde profiel te uploaden';
$LNG['ttl_delete_avatar'] = 'Verwijder je afbeelding huidige profiel';

$LNG['opt_public'] = 'openbaar';
$LNG['opt_private'] = 'prive';
$LNG['opt_semi_private'] = 'Alleen ingeschreven toegestaan';

$LNG['opt_offline_off'] = 'Online (indien beschikbaar)';
$LNG['opt_offline_on'] = 'Altijd Offline';

$LNG['no_gender'] = 'Geen Geslacht';
$LNG['male'] = 'Man';
$LNG['female'] = 'Vrouw';

$LNG['ttl_upload'] = 'Upload';
$LNG['ttl_password'] = 'Wachtwoord';
$LNG['sub_password'] = 'Voer een nieuw wachtwoord in (minimaal 3 tekens)';
$LNG['save_changes'] = 'Wijzigingen opslaan';
$LNG['ttl_upload_photo'] = 'Upload Foto';
$LNG['ttl_upload_cover'] = 'Upload Omslag foto';
$LNG['ttl_delete_photo'] = 'Verwijder Pofo';

$LNG['ttl_notificationl'] = 'Vind ik leuk Meldingen';
$LNG['sub_notificationl'] = 'Melding weergeven voor <strong>Vind ik leuk</strong>';

$LNG['ttl_notificationc'] = 'Reacties Meldingen';
$LNG['sub_notificationc'] = 'Melding weergeven voor <strong>Reacties</strong>';

$LNG['ttl_notifications'] = 'Berichten Meldingen';
$LNG['sub_notifications'] = 'Melding weergeven voor <strong>Berichten Gedeeld</strong>';

$LNG['ttl_notificationd'] = 'Chat Meldingen';
$LNG['sub_notificationd'] = 'Melding weergeven voor <strong>Chats</strong>';

$LNG['ttl_notificationf'] = 'Vrienden Meldingen';
$LNG['sub_notificationf'] = 'Toon alert en meldingen voor <strong>Vrienden Toevoegingen</strong>';

$LNG['ttl_sound_nn'] = 'Meldingen Geluid';
$LNG['sub_sound_nn'] = 'Geluid afspelen wanneer er een nieuwe melding is ontvangen';

$LNG['ttl_sound_nc'] = 'Chat Geluid';
$LNG['sub_sound_nc'] = 'Geluid afspelen wanneer er een nieuw chat bericht is ontvangen';

$LNG['ttl_email_comment'] = 'Emails op Reacties';
$LNG['sub_email_comment'] = 'Email mijn wanneer iemand een reactie geeft op mijn berichten';

$LNG['ttl_email_like'] = 'Emails op Vind ik leuk';
$LNG['sub_email_like'] = 'Email mijn wanneer iemand het leuk vind';

$LNG['ttl_email_new_friend'] = 'Emails op Nieuwe vrienden';
$LNG['sub_email_new_friend'] = 'Ontvang e-mails wanneer iemand je toevoegt als vriend';

$LNG['user_ttl_sidebar'] = 'Instellingen';

// ADMIN PANEL //
$LNG['admin_login'] = 'Admin Login';
$LNG['admin_user_name'] = 'Gebruikersnaam';
$LNG['desc_admin_user'] = 'Type je Admin Gebruikersnaam in';
$LNG['admin_pass'] = 'Wachtwoord';
$LNG['desc_admin_pass'] = 'Type je Admin Wachtwoord in';
$LNG['admin_menu_general'] = 'Algemene instellingen';
$LNG['admin_menu_security'] = 'Wachtwoord';
$LNG['admin_menu_users'] = 'Gebruikers Beheren';
$LNG['admin_menu_logout'] = 'Afmelden';
$LNG['admin_menu_stats'] = 'Statistieken';
$LNG['admin_menu_users_settings'] = 'Gebruikers Instellingen';
$LNG['admin_menu_themes'] = 'Theme';
$LNG['admin_menu_manage_reports'] = 'Rapporten Beheren';
$LNG['admin_menu_manage_ads'] = 'Advertenties Beheren';

$LNG['admin_ttl_sidebar'] = 'Menu';
$LNG['admin_ttl_general'] = 'Algemene Instellingen';
$LNG['admin_ttl_security'] = 'Wachtwoord Instellingen';
$LNG['admin_ttl_themes'] = 'Themas';
$LNG['admin_ttl_users'] = 'Gebruikers Beheren';
$LNG['admin_ttl_stats'] = 'Statistieken';
$LNG['admin_ttl_users_settings'] = 'Gebruikers Instellingen';
$LNG['admin_ttl_manage_reports'] = 'Rapporten Beheren';
$LNG['admin_ttl_manage_ads'] = 'Advertenties Beheren';

$LNG['admin_desc_general'] = 'Wijzig algemene website instellingen.';
$LNG['admin_desc_users_settings'] = 'Wijzig instellingen algemene gebruikers.';
$LNG['admin_desc_themes']  = 'Wijzig de website interface.';
$LNG['admin_desc_security'] = 'Wijzig je Admin Wachtwoord.';
$LNG['admin_desc_users'] = 'Beheren de geregistreerde gebruikers.';
$LNG['admin_desc_stats'] = 'Gebruikers en site statistieken';
$LNG['admin_desc_edit_users'] = 'Gebruikersinstellingen bewerken';
$LNG['admin_desc_manage_reports'] = 'Beheren gerapporteerde berichten en reacties.';
$LNG['admin_desc_manage_ads'] = 'Beheren de site reclame.';

$LNG['admin_ttl_title'] = 'Titel';
$LNG['admin_sub_title'] = 'De site Tilel';

$LNG['admin_ttl_captcha'] = 'Captcha';
$LNG['admin_sub_captcha'] = 'Zet captcha aan bij registratie';

$LNG['admin_ttl_timestamp'] = 'Timestamp';
$LNG['admin_sub_timestamp'] = 'De berichten, reacties en Chat timestamps';

$LNG['admin_ttl_msg_perpage'] = 'Berichten';
$LNG['admin_sub_msg_perpage'] = 'Het aantal berichten per pagina';

$LNG['admin_ttl_com_perpage'] = 'Reacties';
$LNG['admin_sub_com_perpage'] = 'Het aantal reacties per pagina';

$LNG['admin_ttl_chat_perpage'] = 'Chat';
$LNG['admin_sub_chat_perpage'] = 'Het aantal chatgesprekken per pagina';

$LNG['admin_ttl_smiles'] = 'Emoticons';
$LNG['admin_sub_smiles'] = 'Toestaan ??en transformeren shortcodes op berichten, opmerkingen en chat en emoticons';

$LNG['admin_ttl_nperpage'] = 'Meldingen';
$LNG['admin_sub_nperpage'] = 'Het aantal meldingen worden weergegeven (Meldingen pagina)';

$LNG['admin_ttl_qperpage'] = 'Zoeken';
$LNG['admin_sub_qperpage'] = 'Het aantal zoek resultaten per pagina (Zoek pagina)';

$LNG['admin_ttl_msg_limit'] = 'Berichten Limit';
$LNG['admin_sub_msg_limit'] = 'Het aantal tekens per bericht';

$LNG['admin_ttl_chat_limit'] = 'Chat Limit';
$LNG['admin_sub_chat_limit'] = 'Het aantal toegestane tekens gesprek';

$LNG['admin_ttl_email_user'] = 'Email Gebruikers';
$LNG['admin_sub_email_user'] = 'Email gebruikers bij registratie';

$LNG['admin_ttl_notificationsm'] = 'Berichten Meldingen';
$LNG['admin_sub_notificationsm'] = 'De update interval. Controleren op nieuwe berichten';

$LNG['admin_ttl_notificationsn'] = 'Gebeurtenissen Meldingen';
$LNG['admin_sub_notificationsn'] = 'De update interval. Controleren op nieuwe gebeurtenissen en meldingen';

$LNG['admin_ttl_chatrefresh'] = 'Chat verversen';
$LNG['admin_sub_chatrefresh'] = 'De tijd hoe vaak het chatvenster moet verversen op nieuwe berichten';

$LNG['admin_ttl_timeonline'] = 'Online Gebruikers';
$LNG['admin_sub_timeonline'] = 'De tijd tot online sinds activiteit van de laatste gebruiker worden beschouwd';

$LNG['admin_ttl_image_profile'] = 'Afbeelding grootte (profiel)';
$LNG['admin_sub_image_profile'] = 'De afbeelding grootte toegestaan om te uploaden (profiel omslag en avatar)';

$LNG['admin_ttl_image_format'] = 'Afbeelding Formaat (Profiel)';
$LNG['admin_sub_image_format'] = 'Afbeelding formaat die toegestaan zijn voor uploaden (profiel omslag en avatar), gebruik alleen gif, png, jpg andere formaten worden niet ondersteund';

$LNG['admin_ttl_message_image'] = 'Afbeelding grootte (Berichten)';
$LNG['admin_sub_message_image'] = 'De afbeelding grootte die toegestaan is om te uploaden (Berichten)';

$LNG['admin_ttl_message_format'] = 'Afbeelding formaat (Berichten)';
$LNG['admin_sub_message_format'] = 'Afbeelding formaat die toegestaan zijn voor uploaden (Berichten), gebruik alleen gif, png, jpg andere formaten worden niet ondersteund';

$LNG['admin_ttl_censor'] = 'Scheldwoorden';
$LNG['admin_sub_censor'] = 'Woorden worden gecensureerd (schijden met \',\' [comma])';

$LNG['admin_ttl_ad1'] = 'Advertentie Unit 1';
$LNG['admin_sub_ad1'] = 'Advertentie Unit 1 (bodem van de welkom pagina)';

$LNG['admin_ttl_ad2'] = 'Advertentie Unit 2';
$LNG['admin_sub_ad2'] = 'Advertentie Unit 2 (Sidebar [Tijdlijn pagina])';

$LNG['admin_ttl_ad3'] = 'Advertentie Unit 3';
$LNG['admin_sub_ad3'] = 'Advertentie Unit 3 (Sidebar [Nieuws feed pagina])';

$LNG['admin_ttl_ad4'] = 'Advertentie Unit 4';
$LNG['admin_sub_ad4'] = 'Advertentie Unit 4 (Sidebar [profiel pagina])';

$LNG['admin_ttl_ad5'] = 'Advertentie Unit 5';
$LNG['admin_sub_ad5'] = 'Advertentie Unit 5 (Sidebar [individuele berichten])';

$LNG['admin_ttl_ad6'] = 'Advertentie Unit 6';
$LNG['admin_sub_ad6'] = 'Advertentie Unit 6 (Sidebar [mensen zoekpagina])';

$LNG['admin_ttl_password'] = 'Wachtwoord';
$LNG['admin_sub_password'] = 'Laat het veld leeg als je het niet wilt veranderen';

$LNG['admin_ttl_edit'] = 'Bewerken';
$LNG['admin_ttl_edit_profile'] = 'Bewerk Profiel';

$LNG['admin_ttl_delete'] = 'Verijwder';
$LNG['admin_ttl_delete_profile'] = 'Verwijder Profiel';

$LNG['admin_ttl_mail'] = 'Email';
$LNG['admin_ttl_username'] = 'Gebruikersnaam';
$LNG['admin_ttl_id'] = 'ID'; // As in user ID

$LNG['admin_ttl_mprivacy'] = 'Msg. Type';
$LNG['admin_sub_mprivacy'] = 'Gebruikers berichten privacy standaard (kan worden veranderd in de gebruikers instellingen)';

$LNG['admin_ttl_notificationl'] = 'Vink ik leuk Meldingen';
$LNG['admin_sub_notificationl'] = 'Melding weer geven voor <strong>Vink ik leuk</strong> (kan worden veranderd in de gebruikers instellingen)';

$LNG['admin_ttl_notificationc'] = 'Reacties Meldingen';
$LNG['admin_sub_notificationc'] = 'Melding weer geven voor <strong>Reacties</strong> (kan worden veranderd in de gebruikers instellingen)';

$LNG['admin_ttl_notifications'] = 'Berichten Meldingen';
$LNG['admin_sub_notifications'] = 'Melding weer geven voor <strong>Berichten</strong> (kan worden veranderd in de gebruikers instellingen)';

$LNG['admin_ttl_notificationd'] = 'Chat Meldingen';
$LNG['admin_sub_notificationd'] = 'Melding weer geven voor <strong>Chats</strong> (kan worden veranderd in de gebruikers instellingen)';

$LNG['admin_ttl_notificationf'] = 'Vrienden Meldingen';
$LNG['admin_sub_notificationf'] = 'Toon alert en meldingen voor <strong>Vrienden Toevoegingen</strong> (kan worden veranderd in de gebruikers instellingen)';

$LNG['admin_ttl_sound_nn'] = 'Meldingen Geluiden';
$LNG['admin_sub_sound_nn'] = 'Geluid afspelen voor nieuwe meldingen (kan worden veranderd in de gebruikers instellingen)';

$LNG['admin_ttl_sound_nc'] = 'Chat Geluid';
$LNG['admin_sub_sound_nc'] = 'Geluis afspelen voor nieuwe chat berichten (kan worden veranderd in de gebruikers instellingen)';

$LNG['admin_ttl_email_comment'] = 'E-mail op reacties';
$LNG['admin_sub_email_comment'] = 'Activeer het verzenden van e-mails wanneer iemand een reactie heeft gegeven op een bericht';

$LNG['admin_ttl_email_like'] = 'Email op vind ik leuk';
$LNG['admin_sub_email_like'] = 'Activeer het verzenden van e-mails wanneer iemand een vink ik leuk heeft gegeven';

$LNG['admin_ttl_email_new_friend'] = 'Email wanneer Nieuwe Vrienden';
$LNG['admin_sub_email_new_friend'] = 'Activeer het verzenden van e-mails wanneer iemand zich heeft toegevoegd als vriend';

$LNG['admin_ttl_ilimit'] = 'Max. Afbeeldingen';
$LNG['admin_sub_ilimit'] = 'The maximum images allowed to be uploaded per message';

$LNG['admin_ttl_wholiked'] = 'Wie het vind ik leuk vind';
$LNG['admin_sub_wholiked'] = 'Het aantal avatars wat getoond word naast vind ik leuk';

$LNG['admin_ttl_rperpage'] = 'Rapporten';
$LNG['admin_sub_rperpage'] = 'Rapporten per pagina (Rapporten Beheren)';

$LNG['admin_ttl_sperpage'] = 'Vrienden';
$LNG['admin_sub_sperpage'] = 'Aantal vrienden per pagina moet worden weergegeven (profielpagina)';

$LNG['admin_ttl_ronline'] = 'Online Vrienden';
$LNG['admin_sub_ronline'] = 'Aantal online vrienden te worden weergegeven op de Feed/Abonnementen pagina (sidebar).';

$LNG['admin_ttl_nperwidget'] = 'Dropdown Meldingen';
$LNG['admin_sub_nperwidget'] = 'Aantal meldingen per categorie worden weergegeven voor (vind ik leuk, reacties, berichten)';

$LNG['admin_ttl_uperpage'] = 'Gebruikers';
$LNG['admin_sub_uperpage'] = 'Aantal gebruikers per pagina (Gebruikers Beheren)';

$LNG['admin_sub_verified'] = 'Geverifieerd gebruikersprofiel standaard? (Niet aanbevolen)';

$LNG['per_page'] = '/ pagina';
$LNG['second'] = 'seconde';
$LNG['seconds'] = 'seconden';
$LNG['minute'] = 'minuut';
$LNG['minutes'] = 'minuten';
$LNG['hour'] = 'uur';
$LNG['recommended'] = 'aanbevolen';
$LNG['edit_user'] = 'Bewerk Gebruiker';
$LNG['username_to_edit'] = 'Voer een gebruikersnaam in';
$LNG['username_to_edit_sub'] = 'Voer de gebruikersnaam in die je wilt bewerken';

// STATS //
$LNG['user_registration'] = 'Gebruikersregistratie';
$LNG['users_today'] = 'Vandaag';
$LNG['users_this_month'] = 'Deze Maand';
$LNG['users_last_30'] = 'Laatste 30 dagen';
$LNG['total_users'] = 'Totaal';

$LNG['messages'] = 'Bericten';
$LNG['comments'] = 'Reacties';
$LNG['messages_and_comments'] = 'Berichten & Reacties';
$LNG['reports_title'] = 'Rapporten - (Berichten %26 Reacties)';
$LNG['total_messages'] = 'Totaal Berichten';
$LNG['public_messages'] = 'Openbaare Berichten';
$LNG['private_messages'] = 'Prive Berichten';
$LNG['total_comments'] = 'Totaal Reacties';
$LNG['stats_total'] = 'Totaal';
$LNG['stats_public'] = 'Openbaar';
$LNG['stats_private'] = 'Prive';
$LNG['stats_reports'] = 'Rapporten';
$LNG['total_reports'] = 'Totaal Rapporten';
$LNG['pending_reports'] = 'In Afwachting Rapporten';
$LNG['safe_reports'] = 'Veilige Rapporten';
$LNG['deleted_reports'] = 'Verwijderde Rapporten';
$LNG['likes_today'] = 'Vind ik leuk Vandaag';
$LNG['likes_this_month'] = 'Vind ik leuk deze Maand';
$LNG['likes_last_30'] = 'Laatste 30 dagen';
$LNG['likes_total'] = 'Totaal Vink ik leuk';
$LNG['likes'] = 'Vind ik leuk';

// MANAGE REPORTS //
$LNG['admin_reports_id'] = 'ID';
$LNG['admin_reports_view'] = 'Bekijk het Rapport';
$LNG['admin_reports_type'] = 'Type';
$LNG['admin_reports_by'] = 'Gerapporteerd door';
$LNG['admin_reports_safe'] = 'Markeren Veilig';
$LNG['admin_reports_delete'] = 'Verwijderen';
$LNG['admin_reports_ttl_safe'] = 'Markeren als veilig';

// LIKES //
$LNG['already_liked'] = 'Je vind dit al leuk.';
$LNG['already_disliked'] = 'Je vind dit bericht al niet meer leuk.';
$LNG['like'] = 'Vind ik leuk';
$LNG['dislike'] = 'Vind ik niet leuk';
$LNG['like_message_not_exist'] = 'Dit bericht bestaat niet of is verwijderd.';
$LNG['liked_this'] = 'Vind het bericht leuk';
$LNG['x_liked_y_post'] = 'vind %1$s\'s <a href="%2$s">bericht</a> leuk';

// MISC //
$LNG['sponsored'] = 'Gesponsord';
$LNG['censored'] = '<strong>gecensureerd</strong>';
$LNG['new_like_notification'] = '<strong><a href="%s">%s</a></strong> vind je <strong><a href="%s">bericht</a> leuk</strong>';
$LNG['new_comment_notification'] = '<strong><a href="%s">%s</a></strong> heeft gereageerd op je <strong><a href="%s">bericht</a></strong>';
$LNG['new_shared_notification'] = '<strong><a href="%s">%s</a></strong> heeft je <strong><a href="%s">bericht</a> gedeeld</strong>';
$LNG['new_friend_notification'] = '<strong><a href="%s">%s</a></strong> Heeft je toegevoegd als vriend';
$LNG['new_chat_notification'] = '<strong><a href="%s">%s</a></strong> stuurde je een <strong><a href="%s">chat bericht</a></strong>';
$LNG['new_like_fa'] = '<strong><a href="%s">%s</a></strong> Vind <strong><a href="%s">post</a> leuk</strong>';
$LNG['new_comment_fa'] = '<strong><a href="%s">%s</a></strong> heeft gereageerd op een <strong><a href="%s">bericht</a></strong>';
$LNG['new_message_fa'] = '<strong><a href="%s">%s</a></strong> postte een nieuwe <strong><a href="%s">bericht</a></strong>';
$LNG['change_password'] = 'Wachtwoord Wijzigen';
$LNG['enter_new_password'] = 'Voer uw nieuw wachtwoord in';
$LNG['enter_reset_key'] = 'Voer de herstel sleutel in';
$LNG['enter_username'] = 'Voer Gebruikersnaam in';
$LNG['reset_key'] = 'Hersel Sleutel';
$LNG['new_password'] = 'Nieuw Wachtwoord';
$LNG['password_recovery'] = 'Wachtwoord Herstel';
$LNG['recover']	= 'Herstel';
$LNG['recover_sub_username'] = 'Type de gebruikersnaam die je wilt herstellen.';

// PROFILE //
$LNG['profile_not_exist'] = 'Sorry, maar deze gebruiker profiel bestaat niet.';
$LNG['profile_semi_private'] = 'Sorry, maar dit profiel is prive, alleen vrienden kunnen het profiel bekijken.';
$LNG['profile_private'] = 'Sorry, maar dit profiel is volledig prive.';
$LNG['profile_not_exist_ttl'] = 'Profiel bestaat niet.';
$LNG['profile_semi_private_ttl'] = 'Profiel is prive.';
$LNG['profile_private_ttl'] = 'Profiel is prive.';
$LNG['add_friend'] = 'Toevoegen als vriend';
$LNG['remove_friend'] = 'Verwijder vriend';
$LNG['profile_about'] = 'Over';
$LNG['profile_born'] = 'Geboren';
$LNG['profile_location'] = 'Plaats';
$LNG['profile_website'] = 'Homepage';
$LNG['profile_view_site'] = 'Bekijk website';
$LNG['profile_view_profile'] = 'Bekijk Profiel';
$LNG['profile_bio']	= 'Bio';
$LNG['new_messages_posted'] = 'Nieuw bericht(en) zijn geplaatst. Klik om te vernieuwen.';
$LNG['verified_user'] = 'Geverifieerd Gebruiker';
$LNG['edit_profile_cover'] = 'Wijzig Profiel Afbeeldingen';
$LNG['view_all_notifications'] = 'Bekijk Meer Meldingen';
$LNG['view_chat_notifications'] = 'Bekijk Meer Berichten';
$LNG['close_notifications'] = 'Sluit Meldingen';
$LNG['notifications_settings'] = 'Meldingen Instellingen';
$LNG['no_notifications'] = 'Geen Meldingen';
$LNG['search_title'] = 'Zoekresultaten';
$LNG['view_all_results'] = 'Bekijk alle resultaten';
$LNG['close_results'] = 'Sluit Resultaten';
$LNG['no_results'] = 'Er zijn geen resultaten beschikbaar. Probeer een andere zoekopdracht.';
$LNG['no_results_ttl'] = 'Zoekresultaten';
$LNG['search_for_users'] = 'Zoeken naar gebruikers';
$LNG['search_in_friends'] = 'Zoek in Vrienden';
$LNG['follows'] = 'Volgers';
$LNG['followed_by'] = 'Gevolgd door';
$LNG['people'] = 'mensen';

// GENERAL //
$LNG['title_profile'] = 'Profiel';
$LNG['title_feed'] = 'Nieuws Feed';
$LNG['title_post'] = 'Post';
$LNG['title_messages'] = 'Berichten';
$LNG['title_settings'] = 'Instellingen';
$LNG['title_timeline'] = 'Tijdlijn';
$LNG['title_search'] = 'Zoeken';
$LNG['title_notifications'] = 'Meldingen';
$LNG['title_admin']	= 'Admin';
$LNG['on'] = 'Aan';
$LNG['off'] = 'Uit';
$LNG['none'] = 'Geen';
$LNG['pages'] = 'Pagina';
$LNG['search_for_people'] = 'zoeken mensen, hashtags';
$LNG['new_message'] = 'Nieuw Bericht';
$LNG['privacy_policy'] = 'Privacybeleid';
$LNG['terms_of_use'] = 'Gebruiksvoorwaarden';
$LNG['about'] = 'Over';
$LNG['disclaimer'] = 'Disclaimer';
$LNG['contact'] = 'Contact';
$LNG['api_documentation'] = 'API Documentatie';
$LNG['developers'] = 'Ontwikkelaars';
$LNG['language'] = 'Taal';

// MONTHS
$LNG['month_1'] = 'Januari';
$LNG['month_2'] = 'Februari';
$LNG['month_3'] = 'Maart';
$LNG['month_4'] = 'April';
$LNG['month_5'] = 'Mei';
$LNG['month_6'] = 'Juni';
$LNG['month_7'] = 'Juli';
$LNG['month_8'] = 'Augustus';
$LNG['month_9'] = 'September';
$LNG['month_10'] = 'Oktober';
$LNG['month_11'] = 'November';
$LNG['month_12'] = 'December';
?>