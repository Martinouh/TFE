<?php

    require __DIR__ . '/vendor/autoload.php';
    use \Ovh\Api;
    /**
     *
     */
    class APIcall
    {
        private $ovh;
        private $application_key;
        private $application_secret;
        private $end_point;
        private $consumer_key;


        function __construct($application_key,$application_secret,$end_point,$consumer_key)
        {
            $this->application_key = $application_key;
            $this->application_secret = $application_secret;
            $this->end_point = $end_point;
            $this->consumer_key = $consumer_key;

        }

        public function api_connection()
        {
            /**
             * Instanciate an OVH Client.
             * You can generate new credentials with full access to your account on the token creation page
             */

             $this->ovh = new Api( $this->application_key,  // Application Key
                             $this->application_secret,  // Application Secret
                             $this->end_point,      // Endpoint of API OVH Europe (List of available endpoints)
                             $this->consumer_key); // Consumer Key
        }

        public function get_vps_name()
        {
            /**
              * Return the list of all vps on the ovh account
              * Ex :
              *      ["vps394121.ovh.net",
              *      "vps394120.ovh.net"]
            **/
            $array_vps_name = $this->ovh->get('/vps');
        }

        public function get_vps_ip($array_vps_name)
        {
            /**
              * Return the IPv4 & v6 for a given vps in an array Retourne l'IPv4 & v6 d'un vps dans un array
              * Ex: $this->ovh->get('/vps/vps394120.ovh.net/ips') will return this;
              *["51.255.160.103","2001:41d0:302:2100:0000:0000:0000:1ece"]
            **/

            /**
              * Here I creat a variable $vps_ip[i] containing the IPv4 & v6 for each vps
            **/
            foreach ($array_vps_name as $key => $value) {
                $vps_ip[($key+1)] = $this->ovh->get('/vps/'.$value.'/ips');
            }
        }

        public function get_vps_template($vps_name)
        {
            /**
              * This will give an array containing all the templates ids possibles for a given vps
              * For example the template which has an id of '142806' matches the distribution 'Docker on Ubuntu 16.04 Server'
            **/
            $result = $this->ovh->get('/vps/'.$vps_name.'/templates');
        }

        public function reinstall_vps($vps_name,$template_id)
        {
            /**
              * This method will reinstall a given vps, the vps_name & a template ID are require
              * By default the distribution will be configured in English
            **/
            $result = $this->ovh->post('/vps/'.$vps_name.'/reinstall', array(
                'doNotSendPassword' => false, // If asked, the installation password will NOT be sent (only if sshKey defined) (type: boolean)
                'templateId' => $template_id, // Required: Id of the vps.Template fetched in /templates list (type: long)
            ));
        }



        public function reboot_vps($vps_name)
        {
            /**
              * Reboot a vps with his name (ex: vps394120.ovh.net)
            **/
            $result = $this->ovh->post('/vps/'.$vps_name.'/reboot');
        }

        public function start_vps($vps_name)
        {
            /**
              * Start a vps with his name (ex: vps394120.ovh.net)
            **/
            $result = $this->ovh->post('/vps/'.$vps_name.'/start');
        }

        public function stop_vps($vps_name)
        {
            /**
              * Stop a vps with his name (ex: vps394120.ovh.net)
            **/
            $result = $this->ovh->post('/vps/'.$vps_name.'/stop');
        }


        public function get_distribution_infos($vps_name)
        {
            /**
              * This will give back the name of the distribution, bit format, template ID, language
            **/
            $result = $this->ovh->get('/vps/'.$vps_name.'/distribution');
        }

        public function get_services_infos($vps_name)
        {
            /**
              * This will give back some serviceInfos such as the expiration date of the vps as well as the creation..
            **/
            $result = $this->ovh->get('/vps/'.$vps_name.'/serviceInfos');
        }

        public function get_vps_status($vps_name)
        {
            /**
              * This will give back the state of (dns,ping,http,https,smtp,ssh)
              * ex: dns: {
              *            port: 53
              *            state: "down"
              *           },
            **/
            $result = $this->ovh->get('/vps/'.$vps_name.'/status');
        }

        public function get_vps_disk_id($vps_name)
        {
            /**
              * This will give the id of the Disks associated for the given vps
            **/
            $result = $this->ovh->get('/vps/'.$vps_name.'/disks');
        }

        public function get_vps_disk_infos($vps_name,$type)
        {
            /**
              * 'max' will give the capacity maximum of the disk, 'used' will give the amount of space used (MiB)
            **/
            $result = $this->ovh->get('/vps/'.$vps_name.'/disks/382722/use', array(
                'type' => $type,
            ));
        }


    }

 ?>
