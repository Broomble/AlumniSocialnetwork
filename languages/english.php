<?php

// Character encoding
$LNG['charset'] = "iso-8859-1";

$LNG['user_success'] = 'User succesfully created!';
$LNG['user_exists'] = 'This username already exists.';
$LNG['email_exists'] = 'This e-mail is already in use.';
$LNG['enrollno_exist'] = 'Enroll No already <strong>Exists</strong>';

$LNG['enrollno_exists'] = 'Enroll No doesn\'t  <strong>Exists</strong>';
$LNG['branch_exists'] = 'Are you sure you are from this <strong>Branch</strong>';
$LNG['course_exists'] = 'Are you sure you are from this <strong>Course</strong>';
$LNG['fname_exists'] = 'Enter correct <strong>Father\'s name</strong>';
$LNG['name_exists'] = 'Enter your correct <strong>Name</strong>';
$LNG['born_exists'] = 'Enter correct Date of Birth';
$LNG['join_exists'] = 'Enter correct Duration of Course';
$LNG['phone_exists'] = 'Phone No already exists';
$LNG['phone_no_error'] = 'Phone No not valid';

$LNG['all_fields'] = 'All fields are required!';
$LNG['user_alnum'] = 'The username must consists only from letters and numbers.';
$LNG['user_too_short'] = 'The username must be between 3 and 32 characters.';
$LNG['invalid_email'] = 'Invalid e-mail!';
$LNG['invalid_user_pw'] = 'Invalid username or password.';
$LNG['invalid_captcha'] = 'Invalid captcha';
$LNG['log_out'] = 'Log Out';
$LNG['hello'] = 'Hello';
$LNG['visitor'] = 'Visitor';
$LNG['register'] = 'Register';
$LNG['login'] = 'Login';
$LNG['Verify'] = 'Verification';
$LNG['Contact'] = 'Contact Details';
$LNG['Employee'] = 'Employment Details';
$LNG['remember'] = 'Remember me';
$LNG['password'] = 'Password';
$LNG['username'] = 'Username';
$LNG['email'] = 'Email';
$LNG['enrollno'] = 'Enroll No';
$LNG['captcha'] = 'Captcha';
$LNG['username_or_email'] = 'Username or email';
$LNG['welcome_title'] = 'Welcome';
$LNG['welcome_desc'] = 'to NIEC Alumni Social Network';
$LNG['welcome_about'] = 'share your memories, connect with others, make new friends.';
$LNG['forgot_password'] = 'Forgot your password?';
$LNG['all_rights_reserved'] = 'All rights reserved';

// NOTIFICATION BOXES //
$LNG['settings_saved'] = 'Settings Saved';
$LNG['nothing_saved'] = 'Nothing Saved';
$LNG['general_settings_saved'] = 'General settings successfully saved.';
$LNG['overall_settings_saved'] = 'Your settings has been successfully updated.';
$LNG['general_settings_unaffected'] = 'No changes detected.';
$LNG['password_changed'] = 'Password Changed';
$LNG['nothing_changed'] = 'Nothing Changed';
$LNG['password_success_changed'] = 'Password successfully changed, you can use your new password now.';
$LNG['incorrect_date'] = 'The selected date is not valid, please pick a valid date.';
$LNG['password_not_changed'] = 'Your password was not changed.';
$LNG['image_saved'] = 'Image Saved';
$LNG['profile_picture_saved'] = 'Your profile image has been changed.';
$LNG['error'] = 'Error';
$LNG['no_file'] = 'You did not selected any files to be uploaded, or the selected file(s) are empty.';
$LNG['file_exceeded'] = 'The selected file size must not exceed <strong>%s</strong> MB.';
$LNG['file_format'] = 'The selected file format is not supported. Upload <strong>%s</strong> file format';
$LNG['image_removed'] = 'Image Removed';
$LNG['profile_picture_removed'] = 'Your profile picture has been removed.';
$LNG['bio_description'] = 'The Bio description should be %s characters or less.';
$LNG['valid_email'] = 'Please enter a valid email.';
$LNG['valid_url'] = 'Please enter a valid URL format.';
$LNG['background_changed'] = 'The background has been successfully changed.';
$LNG['background_not_changed'] = 'The background could not be changed.';
$LNG['password_too_short'] = 'The password must contain at least <strong>3</strong> characters.';
$LNG['enrollno_too_short'] = 'The Enroll no must contain at least <strong>11</strong> digits.';
$LNG['enrollno_invalid'] = 'The Enroll no is <strong>invalid</strong>';
$LNG['something_went_wrong'] = 'Something went wrong!';
$LNG['username_not_found'] = 'We couldn\'t find the choosed username.';
$LNG['userkey_not_found'] = 'The username or the reset key are wrong, make sure you\'ve entered the correct credentials.';
$LNG['password_reseted'] = 'You have succcessfully reseted your passsword, you can now log-in using the new credentials.';
$LNG['email_sent'] = 'E-mail sent';
$LNG['email_reset'] = 'An email containing password reset instructions has been sent. Please allow us up to 24 hours to deliver the message, also check your Spam box if you can\'t find in your Inbox.';
$LNG['user_deleted'] = 'User Deleted';
$LNG['user_has_been_deleted'] = 'User with the ID: <strong>%s</strong> has been deleted.';
$LNG['user_not_deleted'] = 'The selected user (ID: %s) could not be deleted.';
$LNG['user_not_exist'] = 'The selected user does not exist.';
$LNG['theme_changed'] = 'Theme changed';
$LNG['theme_success_changed'] = 'The theme has been successfully changed.';
$LNG['theme_not_changed'] = 'Sorry but the theme could not be changed';
$LNG['notif_saved'] = 'Notifications changed';
$LNG['notif_success_saved'] = 'Notifications has been successfully updated.';

// MAIL CONTENT //
$LNG['welcome_mail'] = 'Welcome to %s';
$LNG['user_created'] = 'Thank you for joining <strong>%s</strong><br /><br />Your username: <strong>%s</strong><br />Your Password: <strong>%s</strong><br /><br />You can log-in at: <a href="%s" target="_blank">%s</a>';
$LNG['recover_mail'] = 'Password Recovery';
$LNG['recover_content'] = 'A password recover was requested, if you didn\'t make this action please ignore this email. <br /><br />Your Username: <strong>%s</strong><br />Your Reset Key: <strong>%s</strong><br /><br />You can reset your password by accessing the following link: <a href="%s/index.php?a=recover&r=1" target="_blank">%s/index.php?a=recover&r=1</a>';
$LNG['ttl_comment_email'] = '%s commented on your message';
$LNG['comment_email'] = 'Hello <strong>%s</strong>,<br /><br /><strong><a href="%s">%s</a></strong> has commented on your <strong><a href="%s">message.</a></strong>
<br /><br /><span style="color: #aaa;">This message was sent automatically, if you don\'t want to receive these type of emails from <strong>%s</strong> in the future, please <a href="%s">Unsubscribe</a>.</span>';
$LNG['ttl_like_email'] = '%s liked your message';
$LNG['like_email'] = 'Hello <strong>%s</strong>,<br /><br /><strong><a href="%s">%s</a></strong> liked your <strong><a href="%s">message.</a></strong>
<br /><br /><span style="color: #aaa;">This message was sent automatically, if you don\'t want to receive these type of emails from <strong>%s</strong> in the future, please <a href="%s">Unsubscribe</a>.</span>';
$LNG['ttl_new_friend_email'] = '%s added you as friend';
$LNG['new_friend_email'] = 'Hello <strong>%s</strong>,<br /><br /><strong><a href="%s">%s</a></strong> added you as friend.
<<br /><br /><span style="color: #aaa;">This message was sent automatically, if you don\'t want to receive these type of emails from <strong>%s</strong> in the future, please <a href="%s">Unsubscribe</a>.</span>';

// ADMIN PANEL //

$LNG['general_link'] = 'General';
$LNG['security_link'] = 'Security';
$LNG['manage_users'] = 'Manage Users';

$LNG['theme_install'] = 'To install a new theme, upload it on the <strong>themes</strong> folder.';
$LNG['theme_author_homepage'] = 'Visit the author homepage';
$LNG['theme_version'] = 'Version';
$LNG['theme_active'] = 'Active';
$LNG['theme_activate'] = 'Activate';
$LNG['theme_by'] = 'By';

// FEED //
$LNG['welcome_feed_ttl'] = 'Welcome to your Feed';
$LNG['welcome_feed'] = 'All the posts from your friends will appear on this page, start by making new friends.';
$LNG['welcome_timeline_ttl'] = 'Welcome to your Timeline feed';
$LNG['welcome_timeline'] = 'All your posts will be displayed on this page, start by sharing your toughts.';
$LNG['leave_comment'] = 'Leave a comment...';
$LNG['post'] = 'Post';
$LNG['view_more_comments'] = 'View more comments';
$LNG['this_post_private'] = 'This message is private';
$LNG['this_post_public'] = 'This message is public';
$LNG['delete_this_comment'] = 'Delete this comment';
$LNG['delete_this_message'] = 'Delete this message';
$LNG['report_this_message'] = 'Report this message';
$LNG['report_this_comment'] = 'Report this comment';
$LNG['view_more_messages'] = 'Load More';
$LNG['food'] = 'I ate at: <strong>%s</strong>';
$LNG['visited'] = 'I visited:  <strong>%s</strong>';
$LNG['played'] = 'I played: <strong>%s</strong>';
$LNG['watched'] = 'I watched: <strong>%s</strong>';
$LNG['listened'] = 'I listened: <strong>%s</strong>';
$LNG['shared'] = 'I shared a <a href="%s"><strong>message</strong></a> from <a href="%s"><strong>%s</strong></a>.';
$LNG['form_title'] = 'Update your status';
$LNG['comment_wrong'] = 'Something went wrong, please refresh the page and try again.';
$LNG['comment_too_long'] = 'Sorry, but the maximum characters allowed per comment is <strong>%s</strong>.';
$LNG['comment_error'] = 'Sorry, we couldn\'t post the comment, please refresh the page and try again.';
$LNG['message_hidden'] = 'Sorry, but this message is private, only the author of the message can see it.';
$LNG['message_hidden_ttl'] = 'Private Message';
$LNG['login_to_lcs'] = 'Log-in to Like, Comment, or Share';
$LNG['comment'] = 'Comment';
$LNG['share'] = 'Share';
$LNG['shared_success'] = 'The post has been successfully shared on your <a href="%s"><strong>timeline</strong></a>.';
$LNG['no_shared'] = 'Sorry but we couldn\'t share the message, please refresh the page and try again.';
$LNG['share_title'] = 'Share this post';
$LNG['share_desc'] = 'Are you sure do you want to share this message on your timeline?';
$LNG['cancel'] = 'Cancel';
$LNG['close'] = 'Close';

// REPORT //
$LNG['1_not_exists'] = 'The reported message does not exist.';
$LNG['0_not_exists'] = 'The reported comment does not exist.';
$LNG['1_already_reported'] = 'This message has already been reported and it will be reviewed in the shortest time, thank you.';
$LNG['0_already_reported'] = 'This comment has already been reported and it will be reviewed in the shortest time, thank you.';
$LNG['1_is_safe'] = 'This message is marked as <strong>safe</strong> by an administrator, thank you for your feedack.';
$LNG['0_is_safe'] = 'This comment is marked as <strong>safe</strong> by an administrator, thank you for your feedack.';
$LNG['1_report_added'] = 'The message has been reported, thank you for your feedback.';
$LNG['0_report_added'] = 'The comment has been reported, thank you for your feedback.';
$LNG['1_report_error'] = 'Sorry but something went wrong while reporting this message, please refresh the page and try again.';
$LNG['0_report_error'] = 'Sorry but something went wrong while reporting this comment, please refresh the page and try again.';
$LNG['1_is_deleted'] = 'The message has been removed, thank you for your feedback.';
$LNG['0_is_deleted'] = 'The comment has been removed, thank you for your feedback.';

// SIDEBAR //
$LNG['filter_events'] = 'Filter events';
$LNG['archive'] = 'Archives';
$LNG['all_events'] = 'All events';
$LNG['sidebar_map'] = 'Places';
$LNG['sidebar_food'] = 'Meals';
$LNG['sidebar_visited'] = 'Visits';
$LNG['sidebar_movie'] = 'Movies';
$LNG['sidebar_game'] = 'Games';
$LNG['sidebar_picture'] = 'Pictures';
$LNG['sidebar_video'] = 'Videos';
$LNG['sidebar_music'] = 'Music';
$LNG['sidebar_shared'] = 'Shared';
$LNG['all_time'] = 'All time';
$LNG['subscriptions'] = 'Friends';
$LNG['subscribers'] = 'Have as friend';
$LNG['welcome'] = 'Welcome';
$LNG['filter_gender'] = 'Filter Gender';
$LNG['sidebar_male'] = 'Male';
$LNG['sidebar_female'] = 'Female';
$LNG['all_genders'] = 'All genders';
$LNG['online_friends'] = 'Online Friends';
$LNG['sidebar_likes'] = 'Likes';
$LNG['sidebar_comments'] = 'Comments';
$LNG['sidebar_friendships'] = 'Friendships';
$LNG['sidebar_chats'] = 'Chats';
$LNG['sidebar_suggestions'] = 'Friends Suggestions';
$LNG['sidebar_trending'] = 'Trending topics';
$LNG['sidebar_friends_activity'] = 'Friends Activity';

// MESSAGES / CHAT //
$LNG['lonely_here'] = 'It\'s lonely here, how about making some friends?';
$LNG['write_message'] = 'Write a message...';
$LNG['chat_too_long'] = 'Sorry, but the maximum characters allowed per chat message is <strong>%s</strong>.';
$LNG['blocked_by'] = 'The message could not be sent. <strong>%s</strong> blocked you.';
$LNG['blocked_user'] = 'The message could not be sent. You\'ve blocked <strong>%s</strong>.';
$LNG['chat_self'] = 'Sorry but we cannot deliver chat messages to yourself.';
$LNG['chat_no_user'] = 'You must select a user to chat with.';
$LNG['view_more_conversations'] = 'View more conversations';
$LNG['block'] = 'Block';
$LNG['unblock'] = 'Unblock';
$LNG['conversation'] = 'Conversation';
$LNG['start_conversation'] = 'You can start a conversation by chosing a person from your friends list.';
$LNG['send_message'] = 'Send Message';

// MESSAGE FORM //
$LNG['label_food'] = 'Add a place where you ate at';
$LNG['label_game'] = 'Add a played game';
$LNG['label_movie'] = 'Add a watched movie';
$LNG['label_visited'] = 'Add a visited location';
$LNG['label_map'] = 'Add a place';
$LNG['label_video'] = 'Share a video link from YouTube or Vimeo';
$LNG['label_music'] = 'Share a SoundCloud link or add a listened song';
$LNG['label_image'] = 'Upload images';
$LNG['message_form'] = 'What\'s on your mind?';
$LNG['file_too_big'] = 'The selected file size (%s) is too big, the maxium file size allowed is <strong>%s</strong>.';
$LNG['format_not_exist'] = 'The selected file (%s) format is invalid, please upload only <strong>%s</strong> image format.';
$LNG['privacy_no_exist'] = 'The selected privacy does not exist, please refresh the page and try again.';
$LNG['event_not_exist'] = 'The selected event does not exist, please refresh the page and try again.';

$LNG['unexpected_message'] = 'An unexpected error has occured, please refresh the page and try again.';
$LNG['message_too_long'] = 'Sorry, but the maximum characters allowed per message is <strong>%s</strong>.';
$LNG['files_selected'] = 'image(s) selected.';
$LNG['too_many_images'] = 'The maximum number of images allowed to be uploaded per message is <strong>%s</strong>, you tried to upload <strong>%s</strong> images.';

// USER PANEL //
$LNG['user_menu_general'] = 'General';
$LNG['user_menu_security'] = 'Password';
$LNG['user_menu_avatar'] = 'Profile';
$LNG['user_menu_notifications'] = 'Notifications';

$LNG['user_ttl_general'] = 'General Settings';
$LNG['user_ttl_security'] = 'Password Settings';
$LNG['user_ttl_avatar'] = 'Profile Settings';
$LNG['user_ttl_notifications'] = 'Notifications Settings';

$LNG['user_desc_general'] = 'Change account, privacy, location settings.';
$LNG['user_desc_security'] = 'Change your password.';
$LNG['user_desc_avatar'] = 'Change your account picture.';
$LNG['user_desc_cover'] = 'Change your cover picture.';
$LNG['user_desc_notifications'] = 'Change notifications settings.';

$LNG['ttl_background'] = 'Backgrounds';
$LNG['sub_background'] = 'Pick a background for your profile';

$LNG['ttl_name'] = 'Name';
$LNG['sub_name'] = 'Enter your name';

$LNG['ttl_course'] = 'Course';
$LNG['sub_course'] = 'Enter your course name';

$LNG['ttl_branch'] = 'Branch';
$LNG['sub_branch'] = 'Enter your branch';

$LNG['ttl_year'] = 'Duration';
$LNG['sub_year'] = 'Enter your duration';

$LNG['ttl_enrollno'] = 'Enroll No';
$LNG['sub_enrollno'] = 'Enter your enroll no';

$LNG['ttl_email'] = 'Email';
$LNG['sub_email'] = 'E-mail will not be displayed';

$LNG['ttl_location'] = 'Location';
$LNG['sub_location'] = 'Where do you live?';

$LNG['ttl_website'] = 'Website';
$LNG['sub_website'] = 'If you have a blog, personal page, enter it';

$LNG['ttl_gender'] = 'Gender';
$LNG['sub_gender'] = 'Select your gender (male or female)';

$LNG['ttl_profile'] = 'Profile';
$LNG['sub_profile'] = 'Profile Privacy';

$LNG['ttl_messages'] = 'Message Privacy';
$LNG['sub_messages'] = 'The default way of posting Messages';

$LNG['ttl_offline'] = 'Chat Status';
$LNG['sub_offline'] = 'The visibility status for the Chat';

$LNG['ttl_facebook'] = 'Facebook';
$LNG['sub_facebook'] = 'Your facebook profile ID.';

$LNG['ttl_twitter'] = 'Twitter';
$LNG['sub_twitter'] = 'Your twitter profile ID.';

$LNG['ttl_google'] = 'Google+';
$LNG['sub_google'] = 'Your google+ profile ID.';

$LNG['ttl_bio'] = 'Bio';
$LNG['sub_bio'] = 'About you (160 characters or less)';

$LNG['ttl_born'] = 'Born Date';
$LNG['sub_born'] = 'Select the date you were born';

$LNG['ttl_not_verified'] = 'Not verified';
$LNG['ttl_verified'] = 'Verified';
$LNG['sub_verified'] = 'Verified badge on user\'s profile';

$LNG['ttl_upload_avatar'] = 'Upload the selected profile image';
$LNG['ttl_delete_avatar'] = 'Delete your current profile image';

$LNG['opt_public'] = 'Public';
$LNG['opt_private'] = 'Private';
$LNG['opt_semi_private'] = 'Only subscribed allowed';

$LNG['opt_offline_off'] = 'Online (when available)';
$LNG['opt_offline_on'] = 'Always Offline';

$LNG['no_gender'] = 'No Gender';
$LNG['male'] = 'Male';
$LNG['female'] = 'Female';

$LNG['btech'] = 'Bachelor of Technology';
$LNG['mca'] = 'Master of Computer Applications';
$LNG['mba'] = 'Master of Business Administration';
$LNG['bca'] = 'Bachelor of Computer Applications';


$LNG['ece'] = 'Electronics and Communication';
$LNG['cse'] = 'Computer Science';
$LNG['eee'] = 'Electrical and Electronics';
$LNG['it'] = 'Information and Technology';
$LNG['ce'] = 'Civil';
$LNG['mae'] = 'Mechanical and Automation';



$LNG['ttl_upload'] = 'Upload';
$LNG['ttl_password'] = 'Password';
$LNG['sub_password'] = 'Enter a new password (at least 3 characters)';
$LNG['save_changes'] = 'Save Changes';
$LNG['ttl_upload_photo'] = 'Upload Photo';
$LNG['ttl_upload_cover'] = 'Upload Cover';
$LNG['ttl_delete_photo'] = 'Delete Photo';

$LNG['ttl_notificationl'] = 'Likes Notifications';
$LNG['sub_notificationl'] = 'Display alert and notifications for <strong>Likes</strong>';

$LNG['ttl_notificationc'] = 'Comments Notifications';
$LNG['sub_notificationc'] = 'Display alert and notifications for <strong>Comments</strong>';

$LNG['ttl_notifications'] = 'Messages Notifications';
$LNG['sub_notifications'] = 'Display alert and notifications for <strong>Shared Messages</strong>';

$LNG['ttl_notificationd'] = 'Chat Notifications';
$LNG['sub_notificationd'] = 'Display alert and notifications for <strong>Chats</strong>';

$LNG['ttl_notificationf'] = 'Friends Notifications';
$LNG['sub_notificationf'] = 'Display alert and notifications for <strong>Friends Additions</strong>';

$LNG['ttl_sound_nn'] = 'Notifications Sound';
$LNG['sub_sound_nn'] = 'Play a sound when a new notification is received';

$LNG['ttl_sound_nc'] = 'Chat Sound';
$LNG['sub_sound_nc'] = 'Play a sound when a new chat message is received';

$LNG['ttl_email_comment'] = 'Emails on Comments';
$LNG['sub_email_comment'] = 'Receive e-mails when someone comments on your messages';

$LNG['ttl_email_like'] = 'Emails on Likes';
$LNG['sub_email_like'] = 'Receive e-mails when someone likes your messages';

$LNG['ttl_email_new_friend'] = 'Emails on New Friends';
$LNG['sub_email_new_friend'] = 'Receive e-mails when someone adds you as friend';

$LNG['user_ttl_sidebar'] = 'Settings';

// ADMIN PANEL //
$LNG['admin_login'] = 'Admin LogIn';
$LNG['admin_user_name'] = 'Username';
$LNG['desc_admin_user'] = 'Type in your Admin Username';
$LNG['admin_pass'] = 'Password';
$LNG['desc_admin_pass'] = 'Type in your Admin Password';
$LNG['admin_menu_general'] = 'General Settings';
$LNG['admin_menu_security'] = 'Password';
$LNG['admin_menu_users'] = 'Manage Users';
$LNG['admin_menu_logout'] = 'Log Out';
$LNG['admin_menu_stats'] = 'Statistics';
$LNG['admin_menu_users_settings'] = 'Users Settings';
$LNG['admin_menu_themes'] = 'Themes';
$LNG['admin_menu_manage_reports'] = 'Manage Reports';
$LNG['admin_menu_manage_ads'] = 'Manage Ads';

$LNG['admin_ttl_sidebar'] = 'Menu';
$LNG['admin_ttl_general'] = 'General Settings';
$LNG['admin_ttl_security'] = 'Password Settings';
$LNG['admin_ttl_themes'] = 'Themes';
$LNG['admin_ttl_users'] = 'Manage Users';
$LNG['admin_ttl_stats'] = 'Statistics';
$LNG['admin_ttl_users_settings'] = 'Users Settings';
$LNG['admin_ttl_manage_reports'] = 'Manage Reports';
$LNG['admin_ttl_manage_ads'] = 'Manage Advertisments';

$LNG['admin_desc_general'] = 'Change general website settings.';
$LNG['admin_desc_users_settings'] = 'Change general users settings.';
$LNG['admin_desc_themes']  = 'Change the website interface.';
$LNG['admin_desc_security'] = 'Change your Admin Password.';
$LNG['admin_desc_users'] = 'Manage the registered users.';
$LNG['admin_desc_stats'] = 'Users and site statistics';
$LNG['admin_desc_edit_users'] = 'Edit user settings';
$LNG['admin_desc_manage_reports'] = 'Manage reported messages and comments.';
$LNG['admin_desc_manage_ads'] = 'Manage the site\'s advertisment units.';

$LNG['admin_ttl_title'] = 'Title';
$LNG['admin_sub_title'] = 'The site\'s title';

$LNG['admin_ttl_captcha'] = 'Captcha';
$LNG['admin_sub_captcha'] = 'Enable captcha at registration';

$LNG['admin_ttl_timestamp'] = 'Timestamp';
$LNG['admin_sub_timestamp'] = 'The Messages, Comments and Chat timestamps type';

$LNG['admin_ttl_msg_perpage'] = 'Messages';
$LNG['admin_sub_msg_perpage'] = 'The number of messages per page';

$LNG['admin_ttl_com_perpage'] = 'Comments';
$LNG['admin_sub_com_perpage'] = 'The number of comments per message';

$LNG['admin_ttl_chat_perpage'] = 'Chat';
$LNG['admin_sub_chat_perpage'] = 'The number of chat conversations per page';

$LNG['admin_ttl_smiles'] = 'Emoticons';
$LNG['admin_sub_smiles'] = 'Allow and transform shortcodes on Messages, Comments and Chat into emoticons';

$LNG['admin_ttl_nperpage'] = 'Notifications';
$LNG['admin_sub_nperpage'] = 'The number of notifications to be shown (Notifications Page)';

$LNG['admin_ttl_qperpage'] = 'Search';
$LNG['admin_sub_qperpage'] = 'The number of user results per page (Search Page)';

$LNG['admin_ttl_msg_limit'] = 'Messages Limit';
$LNG['admin_sub_msg_limit'] = 'The number of characters allowed per message';

$LNG['admin_ttl_chat_limit'] = 'Chat Limit';
$LNG['admin_sub_chat_limit'] = 'The number of characters allowed per conversation';

$LNG['admin_ttl_email_user'] = 'Email Users';
$LNG['admin_sub_email_user'] = 'E-mail users at registration';

$LNG['admin_ttl_notificationsm'] = 'Messages Notifications';
$LNG['admin_sub_notificationsm'] = 'The update interval to check for new messages';

$LNG['admin_ttl_notificationsn'] = 'Events Notifications';
$LNG['admin_sub_notificationsn'] = 'The update interval to check for new events notifications';

$LNG['admin_ttl_chatrefresh'] = 'Chat Refresh';
$LNG['admin_sub_chatrefresh'] = 'The time how often the chat window updates with new messages';

$LNG['admin_ttl_timeonline'] = 'Online Users';
$LNG['admin_sub_timeonline'] = 'The amount of time to be considered online since the last user\'s activity';

$LNG['admin_ttl_image_profile'] = 'Image Size (Profile)';
$LNG['admin_sub_image_profile'] = 'Image size allowed to upload (profile cover and avatar)';

$LNG['admin_ttl_image_format'] = 'Image Format (Profile)';
$LNG['admin_sub_image_format'] = 'Image format allowed for upload (profile cover and avatar), use only gif,png,jpg other formats are not supported';

$LNG['admin_ttl_message_image'] = 'Image Size (Messages)';
$LNG['admin_sub_message_image'] = 'Image size allowed to upload (Messages)';

$LNG['admin_ttl_message_format'] = 'Image Format (Messages)';
$LNG['admin_sub_message_format'] = 'Image format allowed for upload (Messages), use only gif,png,jpg other formats are not supported';

$LNG['admin_ttl_censor'] = 'Censor';
$LNG['admin_sub_censor'] = 'Words to be censored (divided by \',\' [comma])';

$LNG['admin_ttl_ad1'] = 'Ad Unit 1';
$LNG['admin_sub_ad1'] = 'Advertisement Unit 1 (bottom welcome page)';

$LNG['admin_ttl_ad2'] = 'Ad Unit 2';
$LNG['admin_sub_ad2'] = 'Advertisement Unit 2 (Sidebar [Timeline Page])';

$LNG['admin_ttl_ad3'] = 'Ad Unit 3';
$LNG['admin_sub_ad3'] = 'Advertisement Unit 3 (Sidebar [News Feed Page])';

$LNG['admin_ttl_ad4'] = 'Ad Unit 4';
$LNG['admin_sub_ad4'] = 'Advertisement Unit 4 (Sidebar [profile page])';

$LNG['admin_ttl_ad5'] = 'Ad Unit 5';
$LNG['admin_sub_ad5'] = 'Advertisement Unit 5 (Sidebar [individual messages])';

$LNG['admin_ttl_ad6'] = 'Ad Unit 6';
$LNG['admin_sub_ad6'] = 'Advertisement Unit 6 (Sidebar [people search page])';

$LNG['admin_ttl_password'] = 'Password';
$LNG['admin_sub_password'] = 'Leave it intact if you don\'t want to change it';

$LNG['admin_ttl_edit'] = 'Edit';
$LNG['admin_ttl_edit_profile'] = 'Edit Profile';

$LNG['admin_ttl_delete'] = 'Delete';
$LNG['admin_ttl_delete_profile'] = 'Delete Profile';

$LNG['admin_ttl_mail'] = 'Email';
$LNG['admin_ttl_username'] = 'Username';
$LNG['admin_ttl_id'] = 'ID'; // As in user ID

$LNG['admin_ttl_mprivacy'] = 'Msg. Type';
$LNG['admin_sub_mprivacy'] = 'User\'s message privacy by default (can be changed from user\'s settings)';

$LNG['admin_ttl_notificationl'] = 'Likes Notifications';
$LNG['admin_sub_notificationl'] = 'Display alert and notifications for <strong>Likes</strong> (can be changed from user\'s settings)';

$LNG['admin_ttl_notificationc'] = 'Comments Notifications';
$LNG['admin_sub_notificationc'] = 'Display alert and notifications for <strong>Comments</strong> (can be changed from user\'s settings)';

$LNG['admin_ttl_notifications'] = 'Messages Notifications';
$LNG['admin_sub_notifications'] = 'Display alert and notifications for <strong>Shared Messages</strong> (can be changed from user\'s settings)';

$LNG['admin_ttl_notificationd'] = 'Chat Notifications';
$LNG['admin_sub_notificationd'] = 'Display alert and notifications for <strong>Chats</strong> (can be changed from user\'s settings)';

$LNG['admin_ttl_notificationf'] = 'Friends Notifications';
$LNG['admin_sub_notificationf'] = 'Display alert and notifications for <strong>Friends Additions</strong> (can be changed from user\'s settings)';

$LNG['admin_ttl_sound_nn'] = 'Notifications Sound';
$LNG['admin_sub_sound_nn'] = 'Enable playing a sound for new notifications (can be changed from user\'s settings)';

$LNG['admin_ttl_sound_nc'] = 'Chat Sound';
$LNG['admin_sub_sound_nc'] = 'Enable playing a sound for new chat messages (can be changed from user\'s settings)';

$LNG['admin_ttl_email_comment'] = 'Email on Comment';
$LNG['admin_sub_email_comment'] = 'Enable sending e-mails when someone comments to a message';

$LNG['admin_ttl_email_like'] = 'Email on Like';
$LNG['admin_sub_email_like'] = 'Enable sending e-mails when someone likes a message';

$LNG['admin_ttl_email_new_friend'] = 'Email on New Friend';
$LNG['admin_sub_email_new_friend'] = 'Enable sending e-mails when someone adds a friend';

$LNG['admin_ttl_ilimit'] = 'Max. Images';
$LNG['admin_sub_ilimit'] = 'The maximum images allowed to be uploaded per message';

$LNG['admin_ttl_wholiked'] = 'Who Liked';
$LNG['admin_sub_wholiked'] = 'The number of avatars to be shown near likes number';

$LNG['admin_ttl_rperpage'] = 'Reports';
$LNG['admin_sub_rperpage'] = 'Reports per page (Manage Reports)';

$LNG['admin_ttl_sperpage'] = 'Friends';
$LNG['admin_sub_sperpage'] = 'Number of friends per page to be displayed (profile page)';

$LNG['admin_ttl_ronline'] = 'Online Friends';
$LNG['admin_sub_ronline'] = 'Number of online friends to be displayed on the Feed/Subscriptions page (sidebar).';

$LNG['admin_ttl_nperwidget'] = 'Dropdown Notifications';
$LNG['admin_sub_nperwidget'] = 'Number of notifications to be shown per category (likes, comments, messages)';

$LNG['admin_ttl_uperpage'] = 'Users';
$LNG['admin_sub_uperpage'] = 'Number of users per page (Manage Users)';

$LNG['admin_sub_verified'] = 'Verified user profile by default? (Not recommended)';

$LNG['per_page'] = '/ page';
$LNG['second'] = 'second';
$LNG['seconds'] = 'seconds';
$LNG['minute'] = 'minute';
$LNG['minutes'] = 'minutes';
$LNG['hour'] = 'hour';
$LNG['recommended'] = 'recommended';
$LNG['edit_user'] = 'Edit User';
$LNG['username_to_edit'] = 'Enter a username';
$LNG['username_to_edit_sub'] = 'Enter the username you want to edit';

// STATS //
$LNG['user_registration'] = 'User Registration';
$LNG['users_today'] = 'Today';
$LNG['users_this_month'] = 'This Month';
$LNG['users_last_30'] = 'Last 30 days';
$LNG['total_users'] = 'Total';

$LNG['messages'] = 'Messages';
$LNG['comments'] = 'Comments';
$LNG['messages_and_comments'] = 'Messages & Comments';
$LNG['reports_title'] = 'Reports - (Messages %26 Comments)';
$LNG['total_messages'] = 'Total Messages';
$LNG['public_messages'] = 'Public Messages';
$LNG['private_messages'] = 'Private Messages';
$LNG['total_comments'] = 'Total Comments';
$LNG['stats_total'] = 'Total';
$LNG['stats_public'] = 'Public';
$LNG['stats_private'] = 'Private';
$LNG['stats_reports'] = 'Reports';
$LNG['total_reports'] = 'Total Reports';
$LNG['pending_reports'] = 'Pending Reports';
$LNG['safe_reports'] = 'Safe Reports';
$LNG['deleted_reports'] = 'Deleted Reports';
$LNG['likes_today'] = 'Likes Today';
$LNG['likes_this_month'] = 'Likes This Month';
$LNG['likes_last_30'] = 'Last 30 days';
$LNG['likes_total'] = 'Total Likes';
$LNG['likes'] = 'Likes';

// MANAGE REPORTS //
$LNG['admin_reports_id'] = 'ID';
$LNG['admin_reports_view'] = 'View the report';
$LNG['admin_reports_type'] = 'Type';
$LNG['admin_reports_by'] = 'Reported by';
$LNG['admin_reports_safe'] = 'Mark Safe';
$LNG['admin_reports_delete'] = 'Delete';
$LNG['admin_reports_ttl_safe'] = 'Mark as safe';

// LIKES //
$LNG['already_liked'] = 'You\'ve already liked this message.';
$LNG['already_disliked'] = 'You\'ve already disliked this message.';
$LNG['like'] = 'Like';
$LNG['dislike'] = 'Unlike';
$LNG['like_message_not_exist'] = 'This message doesn\'t exist or has been deleted.';
$LNG['liked_this'] = 'liked this';
$LNG['x_liked_y_post'] = 'liked %1$s\'s <a href="%2$s"><strong>message</strong></a>';

// MISC //
$LNG['sponsored'] = 'Sponsored';
$LNG['censored'] = '<strong>censored</strong>';
$LNG['new_like_notification'] = '<strong><a href="%s">%s</a></strong> liked your <strong><a href="%s">message</a></strong>';
$LNG['new_comment_notification'] = '<strong><a href="%s">%s</a></strong> commented on your <strong><a href="%s">message</a></strong>';
$LNG['new_shared_notification'] = '<strong><a href="%s">%s</a></strong> shared your <strong><a href="%s">message</a></strong>';
$LNG['new_friend_notification'] = '<strong><a href="%s">%s</a></strong> added you as friend';
$LNG['new_chat_notification'] = '<strong><a href="%s">%s</a></strong> sent you a <strong><a href="%s">chat message</a></strong>';
$LNG['new_like_fa'] = '<strong><a href="%s">%s</a></strong> liked a <strong><a href="%s">message</a></strong>';
$LNG['new_comment_fa'] = '<strong><a href="%s">%s</a></strong> commented on a <strong><a href="%s">message</a></strong>';
$LNG['new_message_fa'] = '<strong><a href="%s">%s</a></strong> posted a new <strong><a href="%s">message</a></strong>';
$LNG['change_password'] = 'Change Password';
$LNG['enter_new_password'] = 'Enter your new password';
$LNG['enter_reset_key'] = 'Enter the reset key';
$LNG['enter_username'] = 'Enter Username';
$LNG['reset_key'] = 'Reset Key';
$LNG['new_password'] = 'New Password';
$LNG['password_recovery'] = 'Password Recovery';
$LNG['recover']	= 'Recover';
$LNG['recover_sub_username'] = 'Type in the username you want to recover the password';

// PROFILE //
$LNG['profile_not_exist'] = 'Sorry, but this user profile does not exist.';
$LNG['profile_semi_private'] = 'Sorry, but this profile is private, only the friends of this user can view the profile.';
$LNG['profile_private'] = 'Sorry, but this profile is completely private.';
$LNG['profile_not_exist_ttl'] = 'Profile does not exist.';
$LNG['profile_semi_private_ttl'] = 'Profile is private.';
$LNG['profile_private_ttl'] = 'Profile is private.';
$LNG['add_friend'] = 'Add as friend';
$LNG['remove_friend'] = 'Remove friend';
$LNG['profile_about'] = 'About';
$LNG['profile_born'] = 'Born';
$LNG['profile_location'] = 'Location';
$LNG['profile_website'] = 'Homepage';
$LNG['profile_view_site'] = 'View website';
$LNG['profile_view_profile'] = 'View Profile';
$LNG['profile_bio']	= 'Bio';
$LNG['new_messages_posted'] = 'New message(s) have been posted. Click to refresh.';
$LNG['verified_user'] = 'Verified User';
$LNG['edit_profile_cover'] = 'Change Profile Images';
$LNG['view_all_notifications'] = 'View More Notifications';
$LNG['view_chat_notifications'] = 'View More Messages';
$LNG['close_notifications'] = 'Close Notifications';
$LNG['notifications_settings'] = 'Notifications Settings';
$LNG['no_notifications'] = 'No notifications';
$LNG['search_title'] = 'Search Results';
$LNG['view_all_results'] = 'View All Results';
$LNG['close_results'] = 'Close Results';
$LNG['no_results'] = 'No results available. Try another search.';
$LNG['no_results_ttl'] = 'Search Results';
$LNG['search_for_users'] = 'Search for users';
$LNG['search_in_friends'] = 'Search in friends';
$LNG['follows'] = 'Follows';
$LNG['followed_by'] = 'Followed by';
$LNG['people'] = 'people';

// GENERAL //
$LNG['title_profile'] = 'Profile';
$LNG['title_feed'] = 'News Feed';
$LNG['title_post'] = 'Post';
$LNG['title_messages'] = 'Messages';
$LNG['title_settings'] = 'Settings';
$LNG['title_timeline'] = 'Timeline';
$LNG['title_search'] = 'Search';
$LNG['title_notifications'] = 'Notifications';
$LNG['title_admin']	= 'Admin';
$LNG['on'] = 'On';
$LNG['off'] = 'Off';
$LNG['none'] = 'None';
$LNG['pages'] = 'Pages';
$LNG['search_for_people'] = 'search people, hashtags';
$LNG['new_message'] = 'New message';
$LNG['privacy_policy'] = 'Privacy Policy';
$LNG['terms_of_use'] = 'Terms of Use';
$LNG['about'] = 'About';
$LNG['disclaimer'] = 'Disclaimer';
$LNG['contact'] = 'Contact';
$LNG['api_documentation'] = 'API Documentation';
$LNG['developers'] = 'Developers';
$LNG['language'] = 'Language';

// MONTHS
$LNG['month_1'] = 'January';
$LNG['month_2'] = 'February';
$LNG['month_3'] = 'March';
$LNG['month_4'] = 'April';
$LNG['month_5'] = 'May';
$LNG['month_6'] = 'June';
$LNG['month_7'] = 'July';
$LNG['month_8'] = 'August';
$LNG['month_9'] = 'September';
$LNG['month_10'] = 'October';
$LNG['month_11'] = 'November';
$LNG['month_12'] = 'December';
?>