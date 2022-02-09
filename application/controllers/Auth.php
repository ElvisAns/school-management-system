<?php
 if (!defined("\x42\101\x53\x45\x50\x41\124\x48")) { die("\116\157\40\x64\x69\162\145\x63\164\40\163\143\162\x69\160\x74\40\x61\143\143\145\163\163\40\x61\x6c\x6c\x6f\167\145\144"); } class Auth extends CI_Controller { public function __construct() { parent::__construct(); $this->load->library("\141\165\164\x68\x69\x74"); $this->load->helper("\141\165\164\150\151\x74"); $this->config->load("\141\165\x74\x68\x69\164"); $this->load->helper("\165\162\154"); } public function index() { if (!logged_in()) { redirect("\x61\165\164\x68\57\x6c\157\147\151\156"); } redirect("\x64\x61\x73\x68\142\157\141\162\144"); } public function login() { if (logged_in()) { redirect("\x61\165\x74\150\x2f\144\141\163\150"); } $this->load->library("\x66\157\x72\155\137\x76\141\154\x69\x64\x61\x74\x69\157\156"); $this->load->helper("\x66\x6f\x72\x6d"); $data["\145\162\x72\157\162"] = false; $this->form_validation->set_rules("\145\155\x61\151\x6c", "\105\x6d\141\x69\154", "\162\x65\x71\165\x69\162\145\144"); $this->form_validation->set_rules("\x70\x61\x73\x73\167\157\x72\144", "\120\141\163\x73\167\157\162\144", "\162\145\x71\x75\x69\x72\145\144"); if ($this->form_validation->run()) { if ($this->authit->login(set_value("\145\x6d\141\151\154"), set_value("\160\141\163\163\x77\x6f\162\x64"))) { redirect("\x61\165\164\150\57\144\141\163\150"); } else { $data["\x65\162\x72\x6f\162"] = "\131\x6f\165\162\x20\x65\155\141\x69\154\x20\141\144\144\x72\145\x73\163\40\x61\x6e\x64\x2f\x6f\162\40\160\141\163\x73\x77\x6f\x72\144\40\x69\163\x20\151\156\x63\157\x72\162\x65\x63\x74\56"; } } $this->load->view("\x6c\157\147\151\156", $data); } public function _signup() { $this->load->library("\146\157\x72\x6d\137\x76\x61\x6c\151\x64\x61\x74\x69\x6f\x6e"); $this->load->helper("\146\x6f\162\155"); $data["\x65\162\162\157\x72"] = ''; $this->form_validation->set_rules("\x65\x6d\x61\x69\x6c", "\x45\x6d\141\151\x6c", "\162\145\x71\x75\x69\162\145\x64\174\166\141\154\151\144\137\145\155\x61\x69\x6c\174\151\x73\137\x75\x6e\151\161\165\145\x5b" . $this->config->item("\141\165\x74\x68\151\164\137\x75\x73\x65\x72\163\x5f\164\141\142\154\145") . "\x2e\145\x6d\141\151\x6c\135"); $this->form_validation->set_rules("\x70\x61\x73\x73\167\157\x72\144", "\x50\x61\163\x73\x77\157\162\144", "\x72\145\x71\165\151\x72\145\144\174\155\x69\x6e\x5f\154\145\156\x67\x74\x68\133" . $this->config->item("\x61\x75\x74\x68\151\164\x5f\160\141\x73\163\x77\157\162\x64\137\x6d\151\156\x5f\154\145\156\x67\x74\x68") . "\x5d"); $this->form_validation->set_rules("\x70\x61\163\163\x77\157\162\x64\137\x63\157\x6e\146", "\103\157\156\146\151\162\x6d\40\x50\x61\163\163\167\x6f\162\x64", "\162\x65\x71\x75\x69\162\x65\x64\x7c\155\x61\164\143\x68\145\x73\133\160\x61\x73\x73\x77\x6f\162\x64\x5d"); if ($this->form_validation->run()) { if ($this->authit->signup(set_value("\145\x6d\141\151\154"), set_value("\x70\x61\x73\163\167\157\162\x64"))) { $this->authit->login(set_value("\x65\155\x61\151\x6c"), set_value("\x70\x61\x73\x73\167\157\162\x64")); redirect("\141\x75\x74\150\x2f\x64\141\163\150"); } else { $data["\145\162\x72\157\x72"] = "\x46\141\151\154\x65\x64\x20\164\x6f\40\163\151\147\x6e\40\165\160\x20\x77\151\164\150\40\164\150\x65\x20\147\151\166\x65\x6e\x20\145\x6d\141\x69\x6c\x20\141\x64\x64\x72\145\x73\163\40\141\156\144\40\x70\x61\163\163\x77\157\x72\x64\x2e"; } } $this->load->view("\141\x75\164\150\x2f\x73\151\x67\156\x75\x70", $data); } public function logout() { if (!logged_in()) { redirect("\141\165\x74\150\57\154\157\147\151\156"); } $this->authit->logout("\x2f"); } public function dash() { if (!logged_in()) { redirect("\141\165\164\x68\x2f\154\x6f\x67\151\x6e"); } redirect("\x64\141\x73\x68\x62\x6f\141\162\x64"); echo "\x48\151\x2c\x20" . user("\145\x6d\x61\151\x6c") . "\x2e\40\131\x6f\165\x20\150\x61\x76\145\40\x73\x75\x63\x63\x65\x73\x73\x66\x75\x6c\x6c\x79\x20\40\154\157\147\147\145\x64\x20\x69\156\56\x20\74\x61\x20\150\x72\145\146\75\42" . site_url("\141\x75\x74\150\x2f\x6c\x6f\147\x6f\165\x74") . "\x22\x3e\x4c\x6f\147\157\165\x74\74\x2f\141\x3e"; } public function _forgot() { if (logged_in()) { redirect("\x61\x75\x74\150\x2f\x64\141\x73\x68"); } $test_emails = $this->config->item("\x61\x75\164\150\151\164\137\164\x65\163\x74\137\x65\x6d\141\151\x6c\x73"); $this->load->library("\x66\157\162\155\137\166\x61\x6c\151\x64\x61\x74\x69\157\x6e"); $this->load->helper("\146\157\162\x6d"); $data["\x73\165\143\143\145\163\163"] = false; $this->form_validation->set_rules("\x65\155\x61\151\154", "\105\155\141\x69\154", "\162\x65\x71\x75\x69\162\145\x64\x7c\166\x61\x6c\x69\144\137\145\x6d\x61\151\154\174\x63\141\154\154\x62\141\x63\x6b\137\x65\155\141\x69\x6c\x5f\145\x78\x69\x73\x74\163"); if ($this->form_validation->run()) { $email = $this->input->post("\145\x6d\x61\x69\154"); $this->load->model("\141\165\x74\150\151\164\137\x6d\x6f\x64\145\154"); $user = $this->authit_model->get_user_by_email($email); $slug = md5($user->id . $user->email . date("\131\x6d\144")); $this->load->library("\x65\155\141\x69\x6c"); $from = "\47\x6e\157\x72\145\x70\x6c\x79\x40\x65\x78\x61\155\x70\154\145\x2e\143\157\x6d\47\54\40\x27\x45\x78\141\x6d\x70\154\x65\40\101\160\x70\47"; $subject = "\x52\x65\x73\145\x74\40\x79\x6f\165\162\x20\120\x61\163\x73\x77\x6f\x72\144"; $message = "\124\x6f\40\x72\145\163\145\164\x20\x79\157\165\162\x20\160\x61\163\x73\x77\x6f\162\144\40\160\x6c\145\141\163\x65\x20\x63\x6c\x69\143\153\40\x74\150\145\40\x6c\x69\156\x6b\x20\142\145\154\x6f\x77\40\141\156\144\x20\146\x6f\x6c\154\157\167\x20\164\150\145\40\x69\x6e\163\x74\162\x75\143\x74\151\x6f\x6e\163\x3a\xa\x20\x20\x20\40\40\x20\12" . site_url("\x61\165\x74\150\x2f\x72\x65\163\145\x74\x2f" . $user->id . "\x2f" . $slug) . "\xa\12\x49\146\40\x79\x6f\x75\x20\144\x69\144\40\156\157\x74\x20\x72\x65\x71\x75\145\163\164\40\164\157\40\x72\x65\x73\x65\164\x20\x79\157\165\162\40\x70\141\x73\163\x77\x6f\x72\144\40\164\x68\x65\156\40\x70\x6c\x65\141\x73\x65\x20\152\165\163\x74\40\x69\147\156\157\x72\x65\x20\x74\x68\x69\163\40\x65\x6d\x61\x69\154\x20\141\x6e\144\40\x6e\x6f\40\143\x68\x61\x6e\147\x65\x73\x20\167\151\154\x6c\40\x6f\143\143\x75\162\x2e\12\12\116\x6f\x74\x65\x3a\x20\x54\150\x69\x73\x20\162\x65\163\x65\164\40\x63\157\x64\145\40\167\x69\154\x6c\x20\x65\x78\160\x69\x72\145\x20\x61\146\x74\x65\162\40" . date("\152\40\115\40\131") . "\x2e"; $this->email->from($from); $this->email->to($email); $this->email->subject($subject); $this->email->message($message); if ($test_emails) { $this->savemails("\x50\x61\163\x73\167\157\162\144\x20\x52\145\x73\x65\164", $this->email->protocol, $this->email->mailtype, $from, $email, $subject, $message); } else { $this->email->send(); } $data["\163\165\x63\143\x65\x73\163"] = true; } $this->load->view("\x61\165\x74\x68\x2f\x66\157\162\147\157\164\x5f\160\141\x73\163\167\157\x72\144", $data); } public function savemails($origin, $protocol, $mailtype, $from, $email, $subject, $message) { $obj = new stdClass(); $obj->origin = $origin; $obj->protocol = $protocol; $obj->mailtype = $mailtype; $obj->curentdate = date("\162"); $obj->from = $from; $obj->email = $email; $obj->subject = $subject; $obj->message = $message; $emailobj = serialize($obj); $email_db = getcwd() . DIRECTORY_SEPARATOR . "\x61\x70\x70\x6c\x69\x63\141\x74\151\157\x6e" . DIRECTORY_SEPARATOR . "\x74\x65\x73\x74\x5f\x65\x6d\x61\151\154\x73" . DIRECTORY_SEPARATOR . "\164\x65\x73\164\145\155\x61\x69\154\163\56\144\x62"; if (is_writable($email_db)) { $fp = fopen($email_db, "\x77"); fwrite($fp, $emailobj); fclose($fp); } } public function sentemails() { $email_db = getcwd() . DIRECTORY_SEPARATOR . "\141\160\x70\x6c\151\x63\x61\164\x69\157\156" . DIRECTORY_SEPARATOR . "\x74\x65\x73\x74\137\145\x6d\141\151\154\x73" . DIRECTORY_SEPARATOR . "\x74\145\163\164\x65\x6d\141\151\x6c\163\56\144\x62"; if (file_exists($email_db)) { $emailobj = file_get_contents($email_db); $obj = unserialize($emailobj); if (!empty($obj)) { ?>

                <!DOCTYPE html>
                <html lang="en">
                <head>
                    <meta charset="utf-8">
                    <title>Emails Sent</title>
                    <style type="text/css">

                        ::selection { background-color: #E13300; color: white; }
                        ::-moz-selection { background-color: #E13300; color: white; }

                        body {
                            background-color: #fff;
                            margin: 40px;
                            font: 13px/20px normal Helvetica, Arial, sans-serif;
                            color: #4F5155;
                        }

                        a {
                            color: #003399;
                            background-color: transparent;
                            font-weight: normal;
                        }

                        h1 {
                            color: #444;
                            background-color: transparent;
                            border-bottom: 1px solid #D0D0D0;
                            font-size: 19px;
                            font-weight: normal;
                            margin: 0 0 14px 0;
                            padding: 14px 15px 10px 15px;
                        }

                        code {
                            font-family: Consolas, Monaco, Courier New, Courier, monospace;
                            font-size: 12px;
                            background-color: #f9f9f9;
                            border: 1px solid #D0D0D0;
                            color: #002166;
                            display: block;
                            margin: 14px 0 14px 0;
                            padding: 12px 10px 12px 10px;
                        }

                        #body {
                            margin: 0 15px 0 15px;
                        }

                        p.footer {
                            text-align: right;
                            font-size: 11px;
                            border-top: 1px solid #D0D0D0;
                            line-height: 32px;
                            padding: 0 10px 0 10px;
                            margin: 20px 0 0 0;
                        }

                        #container {
                            margin: 10px;
                            border: 1px solid #D0D0D0;
                            box-shadow: 0 0 8px #D0D0D0;
                        }
                    </style>
                </head>
                <body>
                <div id="container">

                    <h1>Email Preview</h1>

                    <div id="body">
                        <h3>Details</h3>
                        <ul>
                            <li><strong>Origin:</strong> <?php  echo isset($obj->origin) ? $obj->origin : ''; ?>
</li>
                            <li><strong>Protocol:</strong> <?php  echo isset($obj->protocol) ? $obj->protocol : ''; ?>
</li>
                            <li><strong>Mail type:</strong> <?php  echo isset($obj->mailtype) ? $obj->mailtype : ''; ?>
</li>
                            <li><strong>Sent At:</strong> <?php  echo isset($obj->curentdate) ? $obj->curentdate : ''; ?>
</li>
                        </ul>

                        <hr />
                        <p><strong>To:</strong> <?php  echo isset($obj->email) ? $obj->email : ''; ?>
</p>
                        <p><strong>From:</strong> <?php  echo isset($obj->from) ? $obj->from : ''; ?>
</p>

                        <p><strong>Subject:</strong> <?php  echo isset($obj->subject) ? $obj->subject : ''; ?>
</p>

                        <p><strong>Message Body:</strong> <?php  echo isset($obj->message) ? $obj->message : ''; ?>
</p>
                    </div>

                </div>
                </body>
                </html>

<?php  } } } public function email_exists($email) { $this->load->model("\x61\x75\164\x68\151\164\137\155\x6f\144\x65\x6c"); if ($this->authit_model->get_user_by_email($email)) { return true; } else { $this->form_validation->set_message("\x65\x6d\x61\x69\154\x5f\x65\x78\151\163\x74\163", "\x57\x65\x20\x63\157\x75\154\144\x6e\47\x74\x20\x66\x69\x6e\144\x20\164\150\x61\x74\x20\145\155\x61\151\154\40\141\144\144\x72\145\163\163\x20\151\156\x20\157\165\162\40\x73\x79\x73\x74\x65\x6d\56"); return false; } } public function reset() { if (logged_in()) { redirect("\x61\x75\x74\x68\57\144\141\163\150"); } $this->load->library("\146\157\x72\155\x5f\166\x61\x6c\x69\144\x61\x74\x69\x6f\x6e"); $this->load->helper("\x66\157\162\x6d"); $data["\163\165\143\143\145\163\163"] = false; $user_id = $this->uri->segment(3); if (!$user_id) { show_error("\x49\156\x76\141\154\x69\x64\x20\x72\x65\x73\145\x74\40\x63\x6f\144\145\56"); } $hash = $this->uri->segment(4); if (!$hash) { show_error("\111\x6e\x76\x61\x6c\151\x64\40\162\x65\x73\x65\164\40\x63\157\x64\x65\x2e"); } $this->load->model("\141\x75\164\150\151\164\x5f\155\x6f\x64\145\x6c"); $user = $this->authit_model->get_user($user_id); if (!$user) { show_error("\111\156\166\141\x6c\x69\144\40\x72\x65\163\145\164\40\143\x6f\x64\x65\x2e"); } $slug = md5($user->id . $user->email . date("\131\x6d\144")); if ($hash != $slug) { show_error("\111\156\166\x61\154\x69\144\40\x72\145\x73\x65\164\x20\143\x6f\x64\145\x2e"); } $this->form_validation->set_rules("\160\x61\x73\x73\x77\x6f\x72\144", "\120\x61\x73\x73\167\157\x72\x64", "\162\x65\161\165\x69\x72\145\144\174\155\151\x6e\137\154\145\156\x67\x74\150\133" . $this->config->item("\141\x75\x74\x68\151\164\137\x70\x61\163\163\x77\157\162\144\137\155\x69\156\137\x6c\145\156\x67\x74\x68") . "\x5d"); $this->form_validation->set_rules("\x70\x61\x73\163\167\x6f\x72\144\x5f\x63\157\x6e\x66", "\x43\157\x6e\146\151\162\x6d\40\120\x61\x73\163\167\x6f\x72\x64", "\x72\x65\x71\x75\151\162\x65\144\174\x6d\141\164\x63\150\145\163\133\x70\x61\x73\x73\167\157\162\x64\135"); if ($this->form_validation->run()) { $this->authit->reset_password($user->id, $this->input->post("\x70\x61\x73\x73\x77\x6f\x72\144")); $data["\x73\x75\x63\143\145\x73\x73"] = true; } $this->load->view("\141\x75\x74\x68\x2f\162\x65\163\x65\164\x5f\160\x61\x73\163\x77\157\x72\x64", $data); } }