<?php
//======================================================================\\
// Author: Pricop Alexandru			                                    \\
// Website: http://pricop.info									        \\
// Email: pricop2008@yahoo.com											\\
// Updated: 8/28/2013 [MM/DD/YYYY]										\\
// Language: Romanian													\\
//======================================================================\\

// Character encoding
$LNG['charset'] = "iso-8859-2";

$LNG['user_success'] = 'Cont creeat cu success.';
$LNG['user_exists'] = 'Numele de utilizator există deja.';
$LNG['email_exists'] = 'Adresa de e-mail este deja folosită.';
$LNG['all_fields'] = 'Toate câmpurile sunt obligatorii.';
$LNG['user_alnum'] = 'Numele de utilizator trebuie să conțină doar litere și cifre.';
$LNG['user_too_short'] = 'Numele de utilizator trebuie să aibă între 3 și 32 caractere.';
$LNG['invalid_email'] = 'E-mail invalid.';
$LNG['invalid_user_pw'] = 'Utilizator sau parola sunt invalide.';
$LNG['invalid_captcha'] = 'Captcha invalid.';
$LNG['log_out'] = 'Deconectare';
$LNG['hello'] = 'Bun venit';
$LNG['visitor'] = 'Vizitator';
$LNG['register'] = 'Înregistrare';
$LNG['login'] = 'Autentificare';
$LNG['password'] = 'Parolă';
$LNG['username'] = 'Utilizator';
$LNG['username_or_email'] = 'Nume utilizator sau email';
$LNG['email'] = 'Email';
$LNG['captcha'] = 'Captcha';
$LNG['welcome_title'] = 'Bine ați venit';
$LNG['welcome_desc'] = 'în rețeaua noastră de socializare';
$LNG['welcome_about'] = 'împarte-ți aminitirile, conectează-te cu alții, fă-ți prieteni noi.';
$LNG['forgot_password'] = 'Ați uitat parola?';
$LNG['all_rights_reserved'] = 'Toate drepturile rezervate';

// NOTIFICATION BOXES //
$LNG['settings_saved'] = 'Setari salvate';
$LNG['nothing_saved'] = 'Nimic salvat';
$LNG['general_settings_saved'] = 'Setările generale au fost salvate.';
$LNG['overall_settings_saved'] = 'Setările d-voastră au fost salvate cu success.';
$LNG['general_settings_unaffected'] = 'Nici o modificare detectată.';
$LNG['password_changed'] = 'Parola a fost schimbată';
$LNG['nothing_changed'] = 'Nimic schimbat';
$LNG['password_success_changed'] = 'Parola a fost schimbată cu success. Puteți folosi noua parolă.';
$LNG['incorrect_date'] = 'Data selectată nu este validă. Vă rugam selectați o dată validă.';
$LNG['password_not_changed'] = 'Parola d-voastră nu a fost schimbată.';
$LNG['image_saved'] = 'Imagine salvată';
$LNG['profile_picture_saved'] = 'Imaginea de profil a fost actualizată.';
$LNG['error'] = 'Eroare';
$LNG['no_file'] = 'Nu ați selectat nici o filă, sau fila pe care incercați să o încarcați este goală.';
$LNG['file_exceeded'] = 'Fișierul selectat nu trebuie să depășească <strong>%s</strong> MB.';
$LNG['file_format'] = 'Format-ul fișierului nu este suportat. Încărcați fișiere doar în formatul <strong>%s</strong>';
$LNG['image_removed'] = 'Imagine ștearsă';
$LNG['profile_picture_removed'] = 'Aasd.';
$LNG['bio_description'] = 'Descrierea Bio trebuie să conțină %s caractere sau mai puțin.';
$LNG['valid_email'] = 'Vă rugam introduceți o adresă de e-mail validă.';
$LNG['valid_url'] = 'Vă rugam introduceți o adresă URL validă.';
$LNG['background_changed'] = 'Imaginea de fundal a fost actualizată cu succes.';
$LNG['background_not_changed'] = 'Imaginea de fundal nu a putut fi schimbată.';
$LNG['password_too_short'] = 'Parola trebuie să conțină măcar <strong>3</strong> caractere.';
$LNG['something_went_wrong'] = 'Ceva n-a mers';
$LNG['username_not_found'] = 'Nu am găsit numele de utilizator ales.';
$LNG['userkey_not_found'] = 'Numele de utilizator sau cheia de resetare sunt greșite. Asigurați-vă ca le-ați introdus corect.';
$LNG['password_reseted'] = 'Parola d-voastră a fost resetată cu succes. Vă puteți autentifica cu noua parolă.';
$LNG['email_sent'] = 'E-mail trimis';
$LNG['email_reset'] = 'Un e-mail conținând instrucțiuni privind resetarea parolei a fost trimis. Vă rugăm așteptați până la 24 de ore pentru a primi e-mailul, de altfel dacă nu-l găsiți în Inbox, căutați-l și în Spam.';
$LNG['user_deleted'] = 'Utilizator șters';
$LNG['user_has_been_deleted'] = 'Utilizatorul cu ID: <strong>%s</strong> a fost șters.';
$LNG['user_not_deleted'] = 'ID-ul utilizatorului selectat (ID: %s) nu a putut fi șters.';
$LNG['user_not_exist'] = 'Utilizatorul selectat nu există.';
$LNG['theme_changed'] = 'Tema schimbată';
$LNG['theme_success_changed'] = 'Tema a fost schimbată cu succes.';
$LNG['theme_not_changed'] = 'Ne pare rău dar tema nu a putut fi schimbată,';
$LNG['notif_saved'] = 'Notificări actualizate';
$LNG['notif_success_saved'] = 'Notificările au fost actualizate cu success.';

// MAIL CONTENT //
$LNG['welcome_mail'] = 'Bine ați venit la %s';
$LNG['user_created'] = 'Mulțumim că v-ați alaturat <strong>%s</strong><br /><br />Nume utilizator: <strong>%s</strong><br />Parola: <strong>%s</strong><br /><br />Vă puteți autentifica la: <a href="%s" target="_blank">%s</a>';
$LNG['recover_mail'] = 'Recuperare parolă';
$LNG['recover_content'] = 'O cerere de recuperare a parolei a fost cerută. Dacă nu d-voastră ați inițiat acțiunea vă rugăm să ignorați acest e-mail. <br /><br />Nume utilizator: <strong>%s</strong><br />Cheia de resetare: <strong>%s</strong><br /><br />Vă puteți reseta parola accesând următorul link: <a href="%s/index.php?a=recover&r=1" target="_blank">%s/index.php?a=recover&r=1</a>';
$LNG['ttl_comment_email'] = '%s a comentat la mesajul d-voastră';
$LNG['comment_email'] = 'Bună ziua <strong>%s</strong>,<br /><br /><strong><a href="%s">%s</a></strong> a comentat la  <strong><a href="%s">mesajul</a></strong> d-voastră.
<br /><br /><span style="color: #aaa;">Acest mesaj a fost trimis automat, dacă nu doriți să mai primiți astfel de mesaje de la <strong>%s</strong> în viitor, vă rugam să vă <a href="%s">Dezabonați</a>.</span>';
$LNG['ttl_like_email'] = 'Lui %s i-a placut mesajul d-voastră';
$LNG['like_email'] = 'Bună ziua <strong>%s</strong>,<br /><br /><strong>Lui <a href="%s">%s</a></strong> i-a placut <strong><a href="%s">mesajul</a> d-voastră.</strong>
<br /><br /><span style="color: #aaa;">Acest mesaj a fost trimis automat, dacă nu doriți să mai primiți astfel de mesaje de la <strong>%s</strong> în viitor, vă rugam să vă <a href="%s">Dezabonați</a>.</span>';
$LNG['ttl_new_friend_email'] = '%s v-a adaugat ca prieten';
$LNG['new_friend_email'] = 'Bună ziua <strong>%s</strong>,<br /><br /><strong><a href="%s">%s</a></strong> v-a adăugat ca prieten(ă).
<br /><br /><span style="color: #aaa;">Acest mesaj a fost trimis automat, dacă nu doriți să mai primiți astfel de mesaje de la <strong>%s</strong> în viitor, vă rugam să vă <a href="%s">Dezabonați</a>.</span>';

// ADMIN PANEL //

$LNG['general_link'] = 'General';
$LNG['security_link'] = 'Securitate';
$LNG['manage_users'] = 'Manageriază Utilizatorii';

$LNG['theme_install'] = 'Pentru a instala o temă, încărcați-o în folderul <strong>themes</strong>.';
$LNG['theme_author_homepage'] = 'Vizitează pagina autorului';
$LNG['theme_version'] = 'Versiune';
$LNG['theme_active'] = 'Activă';
$LNG['theme_activate'] = 'Activează';
$LNG['theme_by'] = 'De';

// FEED //
$LNG['welcome_feed_ttl'] = 'Bine ați venit la Feed-ul d-voastră.';
$LNG['welcome_feed'] = 'Toate mesajele prietenilor d-voastră vor aparea pe aceasta pagină. Începeți prin a vă face prieteni.';
$LNG['welcome_timeline_ttl'] = 'Bine ați venit la Timeline-ul d-voastră';
$LNG['welcome_timeline'] = 'Toate mesajele d-voastră vor fi afișate pe această pagină. Începeți să vă împărtașiți gândurile.';
$LNG['leave_comment'] = 'Lasă un comentariu...';
$LNG['post'] = 'Postează';
$LNG['view_more_comments'] = 'Vezi mai multe comentarii';
$LNG['this_post_private'] = 'Acest mesaj este privat';
$LNG['this_post_public'] = 'Acest mesaj este public';
$LNG['delete_this_comment'] = 'Șterge acest comentariu';
$LNG['delete_this_message'] = 'Șterge acest mesaj';
$LNG['report_this_message'] = 'Raportează acest mesaj';
$LNG['report_this_comment'] = 'Raportează acest comentariu';
$LNG['view_more_messages'] = 'Încarcă mai mult';
$LNG['food'] = 'Am mâncat la: <strong>%s</strong>';
$LNG['visited'] = 'Am vizitat:  <strong>%s</strong>';
$LNG['played'] = 'M-am jucat: <strong>%s</strong>';
$LNG['watched'] = 'Am vizionat: <strong>%s</strong>';
$LNG['listened'] = 'Am ascultat: <strong>%s</strong>';
$LNG['shared'] = 'Am împărtășit <a href="%s"><strong>mesajul</strong></a> lui <a href="%s"><strong>%s</strong></a>.';
$LNG['form_title'] = 'Actualizează-ți starea';
$LNG['comment_wrong'] = 'Ceva a mers prost. Vă rugăm reîncărcați pagina și încercați din nou.';
$LNG['comment_too_long'] = 'Ne pare rău, dar numărul maxim de caractere pe comentariu admis este de <strong>%s</strong>.';
$LNG['comment_error'] = 'Ne pare rău, nu am putut publica comentariul, vă rugăm reîncărcați pagina și încercați din nou.';
$LNG['message_hidden'] = 'Ne pare rău, dar acest mesaj este privat, doar autorul acestui mesaj îl poate vedea.';
$LNG['message_hidden_ttl'] = 'Mesaj Privat';
$LNG['login_to_lcs'] = 'Autentificați-vă pentru pentru a putea Aprecia, Comenta sau Împărtăși';
$LNG['comment'] = 'Comentează';
$LNG['share'] = 'Împarte';
$LNG['shared_success'] = 'Mesajul a fost împărtășit cu success în <a href="%s"><strong>timeline-ul</strong> d-voastră</a>.';
$LNG['no_shared'] = 'Ne pare rău doar nu am putut împărtași mesajul, vă rugăm reînărcați pagina și încercați din nou.';
$LNG['share_title'] = 'Împarte acest mesaj';
$LNG['share_desc'] = 'Sunteți sigur(ă) că vreți să împărtășiți acest mesaj în timeline-ul d-voastră?';
$LNG['cancel'] = 'Anulează';
$LNG['close'] = 'Închide';

// REPORT //
$LNG['1_not_exists'] = 'Mesajul raportat nu există.';
$LNG['0_not_exists'] = 'Comentariul raportat nu există.';
$LNG['1_already_reported'] = 'Acest mesaj a fost deja raportat și v-a fi analizat în cel mai scurt timp posibil, vă mulțumim.';
$LNG['0_already_reported'] = 'Acest ocmentariu a fost deja raportat si v-a fi analizat în cel mai scurt timp posibil, vă multumim.';
$LNG['1_is_safe'] = 'Acest mesaj a fost marcat ca fiind <strong>sigur</strong> de un administrator, vă mulțumim pentru feedback.';
$LNG['0_is_safe'] = 'Acest comentariu a fost marcat ca fiind <strong>sigur</strong> de un administrator, vă mulțumim pentru feedback.';
$LNG['1_report_added'] = 'Mesajul a fost raportat, vă mulțumim de feedback.';
$LNG['0_report_added'] = 'Comentariul a fost raportat, vă mulțumim de feedback.';
$LNG['1_report_error'] = 'Ne pare rău dar ceva a mers prost în timpul raportării acestui mesaj, vă rugăm reîncărcați pagina și încercați din nou.';
$LNG['0_report_error'] = 'Ne pare rau dar ceva a mers prost în timpul raportării acestui mesaj, vă rugam reîncărcați pagina și încercați din nou.';
$LNG['1_is_deleted'] = 'Mesajul a fost șters, vă mulțumim de feedback.';
$LNG['0_is_deleted'] = 'Comentariul a fost șters, vă mulțumim de feedback.';

// SIDEBAR //
$LNG['filter_events'] = 'Filtrează Evenimente';
$LNG['archive'] = 'Arhivă';
$LNG['all_events'] = 'Toate';
$LNG['sidebar_map'] = 'Locuri';
$LNG['sidebar_food'] = 'Mese';
$LNG['sidebar_visited'] = 'Vizite';
$LNG['sidebar_movie'] = 'Filme';
$LNG['sidebar_game'] = 'Jocuri';
$LNG['sidebar_picture'] = 'Fotografii';
$LNG['sidebar_video'] = 'Clipuri';
$LNG['sidebar_music'] = 'Muzică';
$LNG['sidebar_shared'] = 'Împărtășite';
$LNG['all_time'] = 'Tot timpul';
$LNG['subscriptions'] = 'Prieteni';
$LNG['subscribers'] = 'Ca prieten';
$LNG['welcome'] = 'Bine ați venit';
$LNG['filter_gender'] = 'Filtru gen';
$LNG['sidebar_female'] = 'Femeie';
$LNG['sidebar_male'] = 'Bărbat';
$LNG['all_genders'] = 'Toate genurile';
$LNG['online_friends'] = 'Prieteni online';
$LNG['sidebar_likes'] = 'Placute';
$LNG['sidebar_comments'] = 'Comentarii';
$LNG['sidebar_friendships'] = 'Prietenii';
$LNG['sidebar_chats'] = 'Conversații';
$LNG['sidebar_suggestions'] = 'Sugestii prietenii';
$LNG['sidebar_trending'] = 'Subiecte în trend';
$LNG['sidebar_friends_activity'] = 'Activitate Prieteni';

// MESSAGES / CHAT //
$LNG['lonely_here'] = 'Este gol aici, ce ziceți de niște prieteni noi?';
$LNG['write_message'] = 'Scrie un mesaj...';
$LNG['chat_too_long'] = 'Ne pare rău dar numărul maxim de caractere admise este de <strong>%s</strong>.';
$LNG['blocked_by'] = 'Acest mesaj nu s-a putut trimite. <strong>%s</strong> v-a blocat.';
$LNG['blocked_user'] = 'Acest mesaj nu s-a putut trimite. L-ați blocat pe <strong>%s</strong>.';
$LNG['chat_self'] = 'Ne pare rău dar nu puteți trimite un mesaj către d-voastră.';
$LNG['chat_no_user'] = 'Trebuie să alegeți un utilizator cu care să conversați.';
$LNG['view_more_conversations'] = 'Încarcă mai mult din conversație';
$LNG['block'] = 'Blochează';
$LNG['unblock'] = 'Deblochează';
$LNG['conversation'] = 'Conversație';
$LNG['start_conversation'] = 'Puteți începe o conversație alegând o persoană din lista d-voastră de prieteni.';
$LNG['send_message'] = 'Trimite mesaj';

// MESSAGE FORM //
$LNG['label_food'] = 'Adăugați o locație unde ați mâncat';
$LNG['label_game'] = 'Adăugați un joc jucat';
$LNG['label_movie'] = 'Adăugați un film vizionat';
$LNG['label_visited'] = 'Adăugați un loc vizitat';
$LNG['label_map'] = 'Add o locație';
$LNG['label_video'] = 'Împărtășiți un link al unui clip de pe YouTube sau Vimeo';
$LNG['label_music'] = 'Împărtășiți un link SoundCloud sau adăugați o melodie ascultată';
$LNG['label_image'] = 'Încarcăți imagini';
$LNG['message_form'] = 'What\'s on your mind?';
$LNG['file_too_big'] = 'Mărimea fișierului selectat (%s) este prea mare, mărimea maximă a unui fișier admisă este de <strong>%s</strong>.';
$LNG['format_not_exist'] = 'The selected file (%s) format is invalid, please upload only <strong>%s</strong> image format.';
$LNG['privacy_no_exist'] = 'Nivelul de intimitate nu exista, vă rugăm reîncărcați pagina și încercați din nou.';
$LNG['event_not_exist'] = 'Evenimentul selectat nu există. vă rugăm reîncărcați pagina și încercați din nou.';

$LNG['unexpected_message'] = 'O eroare neașteptată a avut loc, vă rugăm reîncărcați pagina și încercați din nou.';
$LNG['message_too_long'] = 'Ne pare rău dar număul maxim de caractere pe mesaj admis este de <strong>%s</strong>.';
$LNG['files_selected'] = 'fotografii selectate.';
$LNG['too_many_images'] = 'Numărul maxim de fotografii admise pe mesaj este de <strong>%s</strong>, ați încercat să încărcați <strong>%s</strong> fotografii.';

// USER PANEL //
$LNG['user_menu_general'] = 'General';
$LNG['user_menu_security'] = 'Parolă';
$LNG['user_menu_avatar'] = 'Profil';
$LNG['user_menu_notifications'] = 'Notificări';

$LNG['user_ttl_general'] = 'Setări Generale';
$LNG['user_ttl_security'] = 'Setări Parolă';
$LNG['user_ttl_avatar'] = 'Setări Profil';
$LNG['user_ttl_notifications'] = 'Setări Notificări';

$LNG['user_desc_general'] = 'Setări cont, intimitate, locație și altele.';
$LNG['user_desc_security'] = 'Schimbați parola.';
$LNG['user_desc_avatar'] = 'Schimbați fotografia profilului.';
$LNG['user_desc_cover'] = 'Schimbați coperta profilului.';
$LNG['user_desc_notifications'] = 'Schimbați setări de notificări.';

$LNG['ttl_background'] = 'Fundaluri';
$LNG['sub_background'] = 'Alegeți un fundal pentru cont-ul d-voastră.';

$LNG['ttl_first_name'] = 'Nume';
$LNG['sub_first_name'] = 'Introduceți numele de familie.';

$LNG['ttl_last_name'] = 'Prenume';
$LNG['sub_last_name'] = 'Introduceți prenumele';

$LNG['ttl_email'] = 'Email';
$LNG['sub_email'] = 'Adresa e-mail nu va fi afișată.';

$LNG['ttl_location'] = 'Locație';
$LNG['sub_location'] = 'Unde locuiți?';

$LNG['ttl_website'] = 'Website';
$LNG['sub_website'] = 'Dacă aveți un blog, o pagina personala, un site, introduceți-l.';

$LNG['ttl_gender'] = 'Sex';
$LNG['sub_gender'] = 'Introduce-ți sex-ul d-voastră (bărbat sau femeie).';

$LNG['ttl_profile'] = 'Profil';
$LNG['sub_profile'] = 'Intimitate Profil.';

$LNG['ttl_messages'] = 'Intimitate Mesaje';
$LNG['sub_messages'] = 'Modalitatea predefinită de a posta mesajele.';

$LNG['ttl_offline'] = 'Vizibilitate Chat';
$LNG['sub_offline'] = 'Starea vizibilitații în chat';

$LNG['ttl_facebook'] = 'Facebook';
$LNG['sub_facebook'] = 'ID-ul d-voastră de facebook.';

$LNG['ttl_twitter'] = 'Twitter';
$LNG['sub_twitter'] = 'ID-ul d-voastră de twitter.';

$LNG['ttl_google'] = 'Google+';
$LNG['sub_google'] = 'ID-ul d-voastră de Google+';

$LNG['ttl_bio'] = 'Bio';
$LNG['sub_bio'] = 'Despre d-voastra (160 de caractere sau mai puțin).';

$LNG['ttl_born'] = 'Data nașterii';
$LNG['sub_born'] = 'Selecteați data nașterii';

$LNG['ttl_not_verified'] = 'Neverificat';
$LNG['ttl_verified'] = 'Verificat';
$LNG['sub_verified'] = 'Icoană de utilizator verificat pe pagina profilului.';

$LNG['ttl_upload_avatar'] = 'Înărcați imaginea pentru profil selectată.';
$LNG['ttl_delete_avatar'] = 'Ștergeți imaginea curenta a profilului.';

$LNG['opt_public'] = 'Public';
$LNG['opt_private'] = 'Privat';
$LNG['opt_semi_private'] = 'Doar prietenii';

$LNG['opt_offline_off'] = 'Online (când sunteți disponibil)';
$LNG['opt_offline_on'] = 'Offline tot timpul';

$LNG['no_gender'] = 'Nici un sex';
$LNG['male'] = 'Bărbat';
$LNG['female'] = 'Femeie';

$LNG['ttl_upload'] = 'Încarcă';
$LNG['ttl_password'] = 'Parolă';
$LNG['sub_password'] = 'Introduceți o parola nouă (cel puțin 3 caractere).';
$LNG['save_changes'] = 'Salvează Modificările';
$LNG['ttl_upload_photo'] = 'Încarcă fotografie';
$LNG['ttl_upload_cover'] = 'Încarcă copertă';
$LNG['ttl_delete_photo'] = 'Șterge fotografie';

$LNG['ttl_notificationl'] = 'Notificări Aprecieri';
$LNG['sub_notificationl'] = 'Afișează alertă și notificare pentru <strong>Aprecieri</strong>';

$LNG['ttl_notificationc'] = 'Notificări Comentarii';
$LNG['sub_notificationc'] = 'Afișează alertă și notificare pentru <strong>Comentarii</strong>';

$LNG['ttl_notifications'] = 'Notificări Mesaje';
$LNG['sub_notifications'] = 'Afișează alertă și notificare pentru <strong>Mesaje Împărtășite</strong>';

$LNG['ttl_notificationd'] = 'Notificări Conversații';
$LNG['sub_notificationd'] = 'Afișează alertă și notificare pentru <strong>Conversații</strong>';

$LNG['ttl_notificationf'] = 'Notificări Prietenii Noi';
$LNG['sub_notificationf'] = 'Afișează alertă și notificare pentru <strong>Prietenii Adăugate</strong>';

$LNG['ttl_sound_nn'] = 'Sunet Notificări';
$LNG['sub_sound_nn'] = 'Cântă un sunet când o notificare nouă este primită';

$LNG['ttl_sound_nc'] = 'Sunet Conversații';
$LNG['sub_sound_nc'] = 'Cântă un sunet când o conversație nouă este primită';

$LNG['ttl_email_comment'] = 'Email la Comentarii';
$LNG['sub_email_comment'] = 'Primește email când cineva comentează la mesajul tău';

$LNG['ttl_email_like'] = 'Email la Aprecieri';
$LNG['sub_email_like'] = 'Primește email când cineva apreciază un mesaj de-al tău';

$LNG['ttl_email_new_friend'] = 'Email la Prietenii Noi';
$LNG['sub_email_new_friend'] = 'Primește email când cineva te adaugă ca prieten';

$LNG['user_ttl_sidebar'] = 'Setări';

// ADMIN PANEL //
$LNG['admin_login'] = 'Autentificare Admin';
$LNG['admin_user_name'] = 'Utilizator';
$LNG['desc_admin_user'] = 'Introduceți numele de Administrator';
$LNG['admin_pass'] = 'Parola';
$LNG['desc_admin_pass'] = 'Introduceți parola de Administrator';
$LNG['admin_menu_general'] = 'Setări Generale';
$LNG['admin_menu_security'] = 'Parolă';
$LNG['admin_menu_users'] = 'Manageriază Utilizatori';
$LNG['admin_menu_logout'] = 'Deconectare';
$LNG['admin_menu_stats'] = 'Statistici';
$LNG['admin_menu_users_settings'] = 'Setări Utilizatori';
$LNG['admin_menu_themes'] = 'Teme';
$LNG['admin_menu_manage_reports'] = 'Manageriază Raportări';
$LNG['admin_menu_manage_ads'] = 'Manageriază Reclame';

$LNG['admin_ttl_sidebar'] = 'Meniu';
$LNG['admin_ttl_general'] = 'Setări Generale';
$LNG['admin_ttl_security'] = 'Setări Parolă';
$LNG['admin_ttl_themes'] = 'Teme';
$LNG['admin_ttl_users'] = 'Manageriază Utilizatori';
$LNG['admin_ttl_stats'] = 'Statistici';
$LNG['admin_ttl_users_settings'] = 'Setări Utilizatori';
$LNG['admin_ttl_manage_reports'] = 'Manageriază Raportări';
$LNG['admin_ttl_manage_ads'] = 'Manageriază Reclame';

$LNG['admin_desc_general'] = 'Schimbă setări generale ale site-ului.';
$LNG['admin_desc_users_settings'] = 'Schimbă setări generale ale utilizatorilor.';
$LNG['admin_desc_themes']  = 'Schimbă interfața site-ului.';
$LNG['admin_desc_security'] = 'Schimbă de Administrator.';
$LNG['admin_desc_users'] = 'Manageriază utilizatorii înregistrați.';
$LNG['admin_desc_stats'] = 'Statistici site și utilizatori';
$LNG['admin_desc_edit_users'] = 'Editează setări utilizator';
$LNG['admin_desc_manage_reports'] = 'Manageriază mesajele și comentariile raportate.';
$LNG['admin_desc_manage_ads'] = 'Manageriază unitățile de anunțuri ale site-ului';

$LNG['admin_ttl_title'] = 'Titlu';
$LNG['admin_sub_title'] = 'Titlu-l site-ului';

$LNG['admin_ttl_captcha'] = 'Captcha';
$LNG['admin_sub_captcha'] = 'Activează Captcha la înregistrare';

$LNG['admin_ttl_timestamp'] = 'Timestamp';
$LNG['admin_sub_timestamp'] = 'Tipul timestamp-ului pentru Mesaje, Comentarii și Conversații';

$LNG['admin_ttl_msg_perpage'] = 'Mesaje';
$LNG['admin_sub_msg_perpage'] = 'Numărul mesajelor pe pagină';

$LNG['admin_ttl_com_perpage'] = 'Comentarii';
$LNG['admin_sub_com_perpage'] = 'Numărul comentariilor pe pagină';

$LNG['admin_ttl_chat_perpage'] = 'Conversații';
$LNG['admin_sub_chat_perpage'] = 'Numărul conversațiilor pe pagină';

$LNG['admin_ttl_smiles'] = 'Emoticoane';
$LNG['admin_sub_smiles'] = 'Permite și transformă text-ul în emoticoane la Mesaje, Comentarii și Conversații';

$LNG['admin_ttl_nperpage'] = 'Notificări';
$LNG['admin_sub_nperpage'] = 'Numărul de notificări afișate (Pagina de Notificări)';

$LNG['admin_ttl_qperpage'] = 'Caută';
$LNG['admin_sub_qperpage'] = 'Numărul de utilizatori afișați pe pagină (Pagina Căutare)';

$LNG['admin_ttl_msg_limit'] = 'Limită Mesaje';
$LNG['admin_sub_msg_limit'] = 'Numărul caracterelor permise pe mesaj';

$LNG['admin_ttl_chat_limit'] = 'Limită Conversațtii';
$LNG['admin_sub_chat_limit'] = 'Numărul caracterelor permise pe conversație';

$LNG['admin_ttl_email_user'] = 'E-mail Utilizatori';
$LNG['admin_sub_email_user'] = 'Trimite e-mail la înregistrare utilizatorilor';

$LNG['admin_ttl_notificationsm'] = 'Notificări Mesaje';
$LNG['admin_sub_notificationsm'] = 'Intervalul de timp pentru a verifica mesaje noi';

$LNG['admin_ttl_notificationsn'] = 'Notificări Evenimente';
$LNG['admin_sub_notificationsn'] = 'Intervalul de timp pentru a verifica Notificări noi';

$LNG['admin_ttl_chatrefresh'] = 'Actualizare Chat';
$LNG['admin_sub_chatrefresh'] = 'Cât de des se actualizează fereastra pentru a afișa conversațiile noi';

$LNG['admin_ttl_timeonline'] = 'Utilizatori Online';
$LNG['admin_sub_timeonline'] = 'Timpul cât un utilizator este considerat online de la ultima sa activate';

$LNG['admin_ttl_image_profile'] = 'Mărime Imagine (Profil)';
$LNG['admin_sub_image_profile'] = 'Mărimea imaginii admise pentru încărcare (imagine și copertă profil)';

$LNG['admin_ttl_image_format'] = 'Format Imagine (Profil)';
$LNG['admin_sub_image_format'] = 'Format imagine admis pentru încărcare (avatar și copertă profil), folosiți doar gif,png,jpg alte formate nu sunt suportate';

$LNG['admin_ttl_message_image'] = 'Mărime Imagine (Mesaje)';
$LNG['admin_sub_message_image'] = 'Mărimea imaginii admise pentru încărcare (Mesaje)';

$LNG['admin_ttl_message_format'] = 'Format Imagine (Mesaje)';
$LNG['admin_sub_message_format'] = 'Format imagine admis pentru încărcare (Mesaje), folosiți doar gif,png,jpg alte formate nu sunt suportate';

$LNG['admin_ttl_censor'] = 'Cenzură';
$LNG['admin_sub_censor'] = 'Cuvintele pentru a fi cenzurate (despărțite de \',\' [virgulă])';

$LNG['admin_ttl_ad1'] = 'Unitate reclamă 1';
$LNG['admin_sub_ad1'] = 'Unitatea 1 de reclamă (subsolul paginii welcome)';

$LNG['admin_ttl_ad2'] = 'Unitate reclamă 2';
$LNG['admin_sub_ad2'] = 'Unitatea 2 de reclamă (Bară Laterală [Pagină Timeline])';

$LNG['admin_ttl_ad3'] = 'Unitate reclamă 3';
$LNG['admin_sub_ad3'] = 'Unitatea 3 de reclamă (Bară Laterală [Pagină News Feed])';

$LNG['admin_ttl_ad4'] = 'Unitate reclamă 4';
$LNG['admin_sub_ad4'] = 'Unitatea 4 de reclamă (Bară Laterală [Pagină Profil])';

$LNG['admin_ttl_ad5'] = 'Unitate reclamă 5';
$LNG['admin_sub_ad5'] = 'Unitatea 5 de reclamă (Bară Laterală [Pagină mesaje individuale])';

$LNG['admin_ttl_ad6'] = 'Unitate reclamă 6';
$LNG['admin_sub_ad6'] = 'Unitatea 6 de reclamă (Bară Laterală [Pagină de căutare])';

$LNG['admin_ttl_password'] = 'Parolă';
$LNG['admin_sub_password'] = 'Lasați câmpul gol dacă nu doriți să o schimbați';

$LNG['admin_ttl_edit'] = 'Editează';
$LNG['admin_ttl_edit_profile'] = 'Editează Profil';

$LNG['admin_ttl_delete'] = 'Șterge';
$LNG['admin_ttl_delete_profile'] = 'Șterge Profil';

$LNG['admin_ttl_mail'] = 'Email';
$LNG['admin_ttl_username'] = 'Utilizator';
$LNG['admin_ttl_id'] = 'ID'; // As in user ID

$LNG['admin_ttl_mprivacy'] = 'Tip Mesaj';
$LNG['admin_sub_mprivacy'] = 'Intimitatea predefinită de a posta un mesaj de către utilizatori (utilizatorul poate schimba această opțiune)';

$LNG['admin_ttl_notificationl'] = 'Notificări Aprecieri';
$LNG['admin_sub_notificationl'] = 'Afișează alertă și notificare pentru <strong>Aprecieri</strong> (utilizatorul poate schimba această opțiune)';

$LNG['admin_ttl_notificationc'] = 'Notificări Comentarii';
$LNG['admin_sub_notificationc'] = 'Afișează alertă și notificare pentru <strong>Comentarii</strong> (utilizatorul poate schimba această opțiune)';

$LNG['admin_ttl_notifications'] = 'Notificări Mesaje';
$LNG['admin_sub_notifications'] = 'Afișează alertă și notificare pentru <strong>Mesaje Împărtășite</strong> (utilizatorul poate schimba această opțiune)';

$LNG['admin_ttl_notificationd'] = 'Notificări Conversații';
$LNG['admin_sub_notificationd'] = 'Afișează alertă și notificare pentru <strong>Conversații</strong> (utilizatorul poate schimba această opțiune)';

$LNG['admin_ttl_notificationf'] = 'Notificări Prietenii';
$LNG['admin_sub_notificationf'] = 'Afișează alertă și notificare pentru <strong>Prietenii Adăugate</strong> (utilizatorul poate schimba această opțiune)';

$LNG['admin_ttl_sound_nn'] = 'Sunet Notificări';
$LNG['admin_sub_sound_nn'] = 'Cântă un sunet când o notificare nouă este primită (utilizatorul poate schimba această opțiune)';

$LNG['admin_ttl_sound_nc'] = 'Sunet Conversații';
$LNG['admin_sub_sound_nc'] = 'Cântă un sunet când o conversație nouă este primită (utilizatorul poate schimba această opțiune)';

$LNG['admin_ttl_email_comment'] = 'Email la Comentarii';
$LNG['admin_sub_email_comment'] = 'Permite trimiterea de emailuri când cineva comentează la un mesaj';

$LNG['admin_ttl_email_like'] = 'Email la Aprecieri';
$LNG['admin_sub_email_like'] = 'Permite trimiterea de emailuri când cineva comentează apreciază un mesaj';

$LNG['admin_ttl_email_new_friend'] = 'Email la Prietenii Noi';
$LNG['admin_sub_email_new_friend'] = 'Permite trimiterea de emailuri când cineva adaugă un prieten nou';

$LNG['admin_ttl_ilimit'] = 'Nr. Max. Imgini';
$LNG['admin_sub_ilimit'] = 'Numărul maxim de imagini permis pentru încărcare în mesaje';

$LNG['admin_ttl_wholiked'] = 'Cine Apreciază';
$LNG['admin_sub_wholiked'] = 'Numărul maxim de avatare afișat lângă numărul de aprecieri';

$LNG['admin_ttl_rperpage'] = 'Report-uri';
$LNG['admin_sub_rperpage'] = 'Numărul de report-uri afișate pe pagină (Manageriază Raportări)';

$LNG['admin_ttl_sperpage'] = 'Prieteni';
$LNG['admin_sub_sperpage'] = 'Numărul de prieteni afișat pe pagină (pagina de profil)';

$LNG['admin_ttl_ronline'] = 'Prieteni Online';
$LNG['admin_sub_ronline'] = 'Numărul de prieteni online afișați pe pagina de Feed/Abonamente (Bară laterală).';

$LNG['admin_ttl_nperwidget'] = 'Notificări Dropdown';
$LNG['admin_sub_nperwidget'] = 'Numărul de notificări afișate pe categorii (Aprecieri, Comentarii, Mesaje)';

$LNG['admin_ttl_uperpage'] = 'Utilizatori';
$LNG['admin_sub_uperpage'] = 'Utilizatori afișați pe pagină (Manageriază Utilizatori)';

$LNG['admin_sub_verified'] = 'Utilizatorii sunt verificați predefinit? (Nu este recomandat)';

$LNG['per_page'] = '/ pagină';
$LNG['second'] = 'secundă';
$LNG['seconds'] = 'secunde';
$LNG['minute'] = 'minut';
$LNG['minutes'] = 'minute';
$LNG['hour'] = 'oră';
$LNG['recommended'] = 'recomandat';
$LNG['edit_user'] = 'Editează User';
$LNG['username_to_edit'] = 'Nume utilizator';
$LNG['username_to_edit_sub'] = 'Introduceți un nume de utilizator pentru a fi editat';

// STATS //
$LNG['user_registration'] = 'Utilizatori Înregistrați';
$LNG['users_today'] = 'Astăzi';
$LNG['users_this_month'] = 'Luna aceasta';
$LNG['users_last_30'] = 'Ultimele 30 zile';
$LNG['total_users'] = 'Total';

$LNG['messages'] = 'Mesaje';
$LNG['comments'] = 'Comentarii';
$LNG['messages_and_comments'] = 'Mesaje & Comentarii';
$LNG['reports_title'] = 'Raportări - (Mesaje %26 Comentarii)';
$LNG['total_messages'] = 'Total Mesaje';
$LNG['public_messages'] = 'Mesaje Publice';
$LNG['private_messages'] = 'Mesaje Private';
$LNG['total_comments'] = 'Total Comentarii';
$LNG['stats_total'] = 'Total';
$LNG['stats_public'] = 'Public';
$LNG['stats_private'] = 'Privat';
$LNG['stats_reports'] = 'Raportări';
$LNG['pending_reports'] = 'Raportări Nerezolvate';
$LNG['total_reports'] = 'Raportări Totale';
$LNG['safe_reports'] = 'Raportări sigure';
$LNG['deleted_reports'] = 'Raportări Șterse';
$LNG['likes_today'] = 'Astăzi';
$LNG['likes_this_month'] = 'Luna Aceasta';
$LNG['likes_last_30'] = 'Ultimele 30 zile';
$LNG['likes_total'] = 'Total';
$LNG['likes'] = 'Aprecieri';

// MANAGE REPORTS //
$LNG['admin_reports_id'] = 'ID';
$LNG['admin_reports_view'] = 'Vezi raportare';
$LNG['admin_reports_type'] = 'Tip';
$LNG['admin_reports_by'] = 'Raportat de';
$LNG['admin_reports_safe'] = 'Rap. Sigur';
$LNG['admin_reports_delete'] = 'Șterge';
$LNG['admin_reports_ttl_safe'] = 'Marchează Sigur';

// LIKES //
$LNG['already_liked'] = 'Ați apreciat deja acest mesaj.';
$LNG['already_disliked'] = 'Ați displăcut deja acest mesaj.';
$LNG['like'] = 'Îmi Place';
$LNG['dislike'] = 'Nu-mi place';
$LNG['like_message_not_exist'] = 'Acest mesaj nu există sau a fost șters.';
$LNG['liked_this'] = 'a apreciat';
$LNG['x_liked_y_post'] = 'a apreciat <a href="%2$s"><strong>mesajul</strong></a> lui %1$s';

// MISC //
$LNG['sponsored'] = 'Sponsorizat';
$LNG['censored'] = '<strong>cenzurat</strong>';
$LNG['new_like_notification'] = '<strong><a href="%s">%s</a></strong> a apreciat <strong><a href="%s">mesajul tău</a></strong>';
$LNG['new_comment_notification'] = '<strong><a href="%s">%s</a></strong> a comentat la <strong><a href="%s">mesajul tău</a></strong>';
$LNG['new_shared_notification'] = '<strong><a href="%s">%s</a></strong> a distribuit <strong><a href="%s">mesajul tău</a></strong>';
$LNG['new_friend_notification'] = '<strong><a href="%s">%s</a></strong> te-a adăugat ca prieten';
$LNG['new_chat_notification'] = '<strong><a href="%s">%s</a></strong> ți-a trimis un <strong><a href="%s">mesaj în chat</a></strong>';
$LNG['new_like_fa'] = '<strong><a href="%s">%s</a></strong> a apreciat un <strong><a href="%s">mesaj</a></strong>';
$LNG['new_comment_fa'] = '<strong><a href="%s">%s</a></strong> a comentat un <strong><a href="%s">mesaj</a></strong>';
$LNG['new_message_fa'] = '<strong><a href="%s">%s</a></strong> a publicat un <strong><a href="%s">mesaj</a></strong>';
$LNG['change_password'] = 'Schimbă parola';
$LNG['enter_new_password'] = 'Introduceți noua parolă';
$LNG['enter_reset_key'] = 'Introduceți cheia de resetare';
$LNG['enter_username'] = 'Introduceți nume utilizator';
$LNG['reset_key'] = 'Cheie Resetare';
$LNG['new_password'] = 'Parolă nouă';
$LNG['password_recovery'] = 'Recuperare Parolă';
$LNG['recover']	= 'Recuperare';
$LNG['recover_sub_username'] = 'Intrdouceți numele de utilizator pentru care doriți să recuperați parola.';

// PROFILE //
$LNG['profile_not_exist'] = 'Ne pare rău dar acest utilizator nu există.';
$LNG['profile_semi_private'] = 'Ne pare rău dar profilul acesta este privat, doar prietenii lui îi pot vizualiza profilul.';
$LNG['profile_private'] = 'Ne pare rău dar acest profil este complet privat.';
$LNG['profile_not_exist_ttl'] = 'Profilul nu există.';
$LNG['profile_semi_private_ttl'] = 'Profil este privat.';
$LNG['profile_private_ttl'] = 'Profil privat.';
$LNG['add_friend'] = 'Adaugă prieten';
$LNG['remove_friend'] = 'Șterge prieten';
$LNG['profile_about'] = 'Despre';
$LNG['profile_born'] = 'Născut';
$LNG['profile_location'] = 'Locație';
$LNG['profile_website'] = 'Pagină personala';
$LNG['profile_view_site'] = 'Vezi website';
$LNG['profile_view_profile'] = 'Vezi profil';
$LNG['profile_bio']	= 'Bio';
$LNG['new_messages_posted'] = 'Mesaje noi au fost publicate. Click pentru împrospătare.';
$LNG['verified_user'] = 'Utilizator Verificat';
$LNG['edit_profile_cover'] = 'Schimbă imagini profi.';
$LNG['view_all_notifications'] = 'Vizualizați mai multe Notificări';
$LNG['view_chat_notifications'] = 'Vizualizați mai multe Mesaje';
$LNG['close_notifications'] = 'Închide notificări';
$LNG['notifications_settings'] = 'Setări notificări';
$LNG['no_notifications'] = 'Nici o notificare';
$LNG['search_title'] = 'Rezultate Căutare';
$LNG['view_all_results'] = 'Vezi Toate Rezultatele';
$LNG['close_results'] = 'Închide Rezultate';
$LNG['no_results'] = 'Nici un rezultat disponibil. Încercați o căutare nouă.';
$LNG['no_results_ttl'] = 'Rezultate Căutare';
$LNG['search_for_users'] = 'Caută utilizatori';
$LNG['search_in_friends'] = 'Caută în prieteni';
$LNG['follows'] = 'Urmărește';
$LNG['followed_by'] = 'Urmărit de';
$LNG['people'] = 'persoane';

// GENERAL //
$LNG['title_profile'] = 'Profil';
$LNG['title_feed'] = 'Noutăți';
$LNG['title_post'] = 'Post';
$LNG['title_messages'] = 'Mesaje';
$LNG['title_settings'] = 'Setări';
$LNG['title_timeline'] = 'Timeline';
$LNG['title_search'] = 'Căutare';
$LNG['title_notifications'] = 'Notificări';
$LNG['title_admin']	= 'Admin';
$LNG['on'] = 'On';
$LNG['off'] = 'Off';
$LNG['none'] = 'None';
$LNG['pages'] = 'Pagini';
$LNG['search_for_people'] = 'caută persoane, hashtag-uri';
$LNG['new_message'] = 'Mesaj nou';
$LNG['privacy_policy'] = 'Politică de confidențialitate';
$LNG['terms_of_use'] = 'Termeni de Utilizare';
$LNG['about'] = 'Despre';
$LNG['disclaimer'] = 'Disclaimer';
$LNG['contact'] = 'Contact';
$LNG['api_documentation'] = 'Documentație API';
$LNG['developers'] = 'Dezvoltatori';
$LNG['language'] = 'Limbă';

// MONTHS
$LNG['month_1'] = 'Ianuarie';
$LNG['month_2'] = 'Februarie';
$LNG['month_3'] = 'Martie';
$LNG['month_4'] = 'Aprile';
$LNG['month_5'] = 'Mai';
$LNG['month_6'] = 'Iunie';
$LNG['month_7'] = 'Iulie';
$LNG['month_8'] = 'August';
$LNG['month_9'] = 'Septembrie';
$LNG['month_10'] = 'Octombrie';
$LNG['month_11'] = 'Noiembrie';
$LNG['month_12'] = 'Decembrie';
?>