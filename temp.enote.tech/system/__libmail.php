<?php

/*
  -------------------------------------------------
  php_libmail v 2.0 (18.10.2013) webi.ru
  ������������� PHP ����� ��� �������� �����
  ����� ���������� ����� ����� smtp(��������� ������), ���� ����� ����������� ������� mail()
  ������������ ������, ��� ������ ������������� � ������, ���� ���������� � ������ � ����� ��������� �������� ������ html ������.
  http://webi.ru/webi_files/php_libmail.html
  adm@webi.ru
  -----------------------
  �� ���� �������� ������ �� adm@webi.ru
  ________________________________________________

  ��� ������:
  ������ 2.0 (18.10.2013)
  ����� ��������� ���� �� ������������� �� ������� �������� PHP. ������ ����� ������� ��� PHP 5 � ����.
  ������������� ������ � ����������� �������� �����������, ��� ������� �������� ����� ��� �� ��� � � ������ ������� ������, ����� Get() - ��������� ����. 
  ������ �� ��������� ��� ��������, ��� ��� � ���� ������ ��������� ����������� ���������� �� ��������� ������ ����� �� ���� ���������� � 
  ���� ������, ��� � ������� ������ ����� ����������� ����, �� ��� ����� �������� ����� ������.
  �������, ���� ��� ����� �������� ��� �������� �����, ������� ����� �������� �������� ���� $m->log_on(true);
  ���������� ��� ������� ����� �� ������������� �������� ������, ����� $m->Send(); ��� ����.
  
  ��������� ����������� ���������� �������� ������������ ������, ��������� ��������� ������ ��������� �� ����������.

  ��������� �� ��������� ������ ������.
  
  ���� �� ����� ������� ���������, ��� ����������� ���������� ������ ������ � �������� ������ ����������.
  ��������, �� ������ ��������� ���������� ��������� ���������� ������, �������� ���
  $m->To( "aser@asd.ru" );
  $m->To( "dhhhh@asd.ru",'gds' );
  $m->To( "afsgdc@asd.ru",54 );
  ��� ��������� ����������. � ����� ������ �� ���� ��������� ������� ������, �� ������������ ������������� ���, �� ���� �������� ������ ��������, 
  ����� email �� �������� �������������� ������� c ��������� id. ID �������� ����� ���� ����� ������ �� ���� � ���� ���������� ��������.
  ����� ����� ���� ��������, �� ��� ������������ � �������� � ������� ������� �������� ������.
  �������� ���� ������ ����� � ���� ������ ���� �������������, �� ����� ��� �� ��������� �������� ����� �������� ���� ���������� �������, 
  ������� ������ ��������� � ��������� � To(). ��� �� � � ����� ����� ������ � �������.
  �� �� ���� ���� ������� �� �����, ��� ��� ������ ����� ������ ����� �� ����.

  � ���� ������ ��������� ����������� ������ � base64 � �������� �� ���������, ������ � ���� ������� ����������������.
  ��� ��������� ������������ ��� ������������� ������
  $m=new Mail('windows-1251','8bit'); 8bit ��������� windows
  $m=new Mail('','8bit');  8bit ��������� ������
  $m=new Mail();  base64 ��������� ������

  ������� ��������� � ������������ HTML ������. ������ ����� �� ������ html ������ ������ ����������, �� � �������������� ��������� ������,
  �� ��� ������, ���� �������� ��������� ���������� �� ���������� html
  $m->Body( '����� <br>�����', "html", "� � ���� ���� ����� ������� ��� �� ����� �����, �� ��� html");
  �� ��������� �������������� ������ ������ �� �����������.

  ������������ ������ �������� ��� � ������. �� ���� ������, ����� ���� ��� ����� ������������� � ���������� ��� ��� �������,
  ����������� �������� attachment
  $m->Attach( "1.jpg", "", "image/jpeg", "attachment");
  � ���� ������ ���� ����� ���������� � ������, ��� �������� attachment, ���� ����� ���������� � ������,
  �������� ���� �� ������ �������� �������� � html, ����� �� ��������� attachment, ����� ��� �������� �� ������ ������������ � ������������� ������,
  �� �� ����� ������������ � html
  <img src="cid:1.jpg"> �������� ���.

  ���������� �������� � ������������ ���� ������ � �������� �������.

  �������� ������ $status_mail, ����� �������� ������ ����� �������� ������ �������� ������.
  $m->status_mail['status'] = false|true; ���� ������ ���������� �������, �� true, � ��������� ������ false
  $m->status_mail['message'] ='�����'; ��������� ��������� ������ ��� ������� ��������

  ----------------------------------
  ������ 1.6.1 (02.10.2013)
  ��������� ����������� ���������� �������� ������ html
  ��� ����� ��� � ������ ������������ �������� � ������
  �������� ��� ��������(����� ����������� ����������, 1.jpg � 1.jpg - ������)
  $m->Attach( "1.jpg", "", "image/jpeg" );
  $m->Attach( "2.jpg", "", "image/jpeg" );
  � � ����� ������ ������ ���������� �������� ���
  <img src="cid:1.jpg">
  <img src="cid:2.jpg">
  ��������
  $m->Body( '����� <img src="cid:1.jpg"><br>�����<img src="cid:2.jpg"><br> �.�.', "html" );
  �������� ��������, ��� ��������� ������ ���� html

  ---------------------------------
  ������ 1.6.0 (09.12.2011)
  ��������� ����������� ��������� ����� � �������� ������
  ��������� � From, To � ReplyTo
  ��� ����������� ����� ����������� ';' ��������
  $m->To( "������;adm@webi.ru" );

  -------------------------------------------
  ������ 1.5.1 (07.02.2011)
  ������������ ������� �������� email ������� �� ���������� ��� php 5.2 � ����.

  -------------------------------------------
  ������ 1.5 (28.02.2010)
  ��������� ��������� �������� ����� � ������� SMTP

  -------------------------------------------
  ������ 1.4 (24.02.2010)

  ��������� � ������� ���������
  ��������� ������ ����� ��������� �� � ���� ������ ��� ���� ������, � ��� ������������� ������ �������� $m= new Mail('windows-1251');
  ���� �� ��������� ���������, �� ��������� ����� windows-1251
  --
  �������� ������������ ������.
  ������� ����� ��������, ��� �����.
  ������ ���������� ���� ��� ����� ���� ������ ���. ��� �������, ����� ������������ ��������� ����� ����������� ����� upload, ��� ��� �� ����� �� ������������ ��������.
  ������ 	$m->Attach( "/toto.gif", "asd.gif" "image/gif" )
  ���� �� ��������� ����� ���, ������� ��� �� ���� �������������� �����
  --
  ��������� ����������� ���������� ������ � ������� html
  _______________________________________________


  ������

  include "libmail.php";

  $m= new Mail('windows-1251');  // ����� ����� ������� ���������, ����� ������ �� ��������� ($m= new Mail;)
  $m->From( "������;asd@asd.com" ); // �� ���� ����� ������������ ���, ���������� ������ � �������
  $m->ReplyTo( '������ �������;replay@bk.ru' ); // ���� ��������, ���� ����� ������� ���
  $m->To( "kuda@asd.ru" );   // ����, � ���� ���� ��� �� ��������� ��������� ���
  $m->Subject( "���� ���������" );
  $m->Body("���������. ����� ������");
  $m->Cc( "kopiya@asd.ru");  // ���� ��������� ����� ������
  $m->Bcc( "skritaya_kopiya@asd.ru"); // ���� ��������� ������� �����
  $m->Priority(4) ;	// ��������� ����������
  $m->Attach( "/toto.gif", "", "image/gif" ) ;	// ������������� ���� ���� image/gif. ���� ����� ��������� �� �����������
  $m->smtp_on("smtp.asd.com","login","passw", 25, 10); // ��������� �� ������� �������� ������ ����� smtp
  $m->log_on(true); // �������� ���, ����� ���������� ��������� ����������
  $m->Send();	// ��������
  echo "������ ����������, ��� �������� ����� ������:<br><pre>", $m->Get(), "</pre>";

  ��������� ���������� ������� �� ����� http://webi.ru/webi_files/php_libmail.html

 */

/**
 * �������� �����
 * @author WeBi <adm@webi.ru>
 * @link http://webi.ru/webi_files/php_libmail.html
 * @version 2.0 (18.10.2013)
 */
class Mail
{

    /**
     * ��������� ������
     * @var string
     * @access private  
     */
    private $charset = "UTF-8";

    /**
     * ����������� ��� ������ �� ���������� ������
     * @var string
     */
    private $boundary = "";

    /**
     * ������ ������ ���� ������
     * @var array 
     */
    private $SubBody = array();

    /**
     * ������� �������������� ���� ������. �� ������� ��������
     * @var array
     */
    private $body = array();

    /**
     * Content-Transfer-Encoding base64|8bit
     * @var string 
     */
    private $ctencoding = "base64";

    /**
     * ������� ��� ������� � ������� ����������� �������� ����� ������
     * @var int
     */
    private $count_body = 1;

    /**
     * �������� ���������� email
     * @var boolean 
     */
    private $checkAddress = true;

    /**
     * ������ � ����������� ������
     * @var array 
     */
    private $headers = array();

    /**
     * ������� ��������� ������
     * @var array
     */
    private $ready_headers = array();

    /**
     * ����� ��� email �������, ����� ������ ��� ("������" <asd@wer.re>)
     * @var array
     */
    private $names_email = array();

    /**
     * ���������� ��������� ��� ��������� ����������� � ���������. �� ��������.
     * @var type 
     */
    private $receipt = 0;

    /**
     * ������ ������� ��� �������� ����� smtp
     * @var array 
     */
    private $smtpsendto = array();

    /**
     * ������ � �������� ���� ����������
     * @var array
     */
    private $sendto = array();

    /**
     * ���� ���������� �������� ����� ������, ��� ����� ������ ���� ��� ���� ���������� ��� ������
     * @var array 
     */
    private $acc = array();

    /**
     * ���� ���������� ������� �����
     * @var array
     */
    private $abcc = array();

    /**
     * ������ � ����������� ��� smtp
     * @var array 
     */
    private $smtp = array();

    /**
     * ��� ������ SMTP ��� mail()
     * @var string
     */
    private $smtp_log = '';

    /**
     * �������������� ���������� ����. ���� �������� ��� �������� �� �����, ����� ���������, ��� ��� ���� ���� �������� ����� �� ���������� ��������, �� ��� � �������, �� ����������� ������ ����� �������
     * �� ��������� ��������� � ����������� ���������
     * @var boolean
     */
    private $log_on = false;

    /**
     * ����� �������� ��������� ������
     * @var array
     */
    private $body_header = array();

    /**
     * ������ ������ ������
     * @var array
     */
    public $status_mail = array('status' => true, "message" => '��');

    /**
     * ������������
     * @param string $charset ��������� ������ 
     * @param string $ctencoding Content-Transfer-Encoding
     */
    public function __construct($charset = "", $ctencoding = '')
    {
        // ������������ �����������
        $this->boundary = md5(uniqid("myboundary"));

        // �� ��������� �������� ����� smtp ���������
        $this->smtp['on'] = false;

        // Content-Transfer-Encoding �� ��������� base64
        if (strlen($ctencoding) and $ctencoding == '8bit')
        {
            $this->ctencoding = '8bit';
        }

        // ��������� ������
        if (strlen($charset))
        {
            $this->charset = strtolower($charset);
            if ($this->charset == "us-ascii")
            {
                $this->ctencoding = "7bit";
            }
        }
    }

    /**
     * ��������� ����� ������
     * @param string $text ����� ������
     * @param string $text_html text|html � ����� ���� ������, � html ��� ������� �����.
     * @param string $alternative_text �������������� �����. ���� ������ � html �� ����� ����� ���� �����, ������� ����� ���������� ���������, ������� �� ����� ���������� html
     * @param string $resource ������-��� ������ ������� ��������� ������ ���������.
     */
    public function Body($text, $text_html = "", $alternative_text = '', $resource = 'webi')
    {
        // �� ��������� ������ webi
        if (!strlen($resource))
            $resource = 'webi';

        if ($text_html == "html")
            $text_html = "text/html";
        else
            $text_html = "text/plain";

        // ���� ������ ��������� � base64, ����� ������������ � base64
        // base64 ��������� �� ������� � ������� chunk_split, ����� ������ �� ���� ����� ������ (��������)
        if ($this->ctencoding == 'base64')
        {
            if (strlen($alternative_text))
                $alternative_text = chunk_split(base64_encode($alternative_text));

            if (strlen($text))
                $text = chunk_split(base64_encode($text));
        }


        // ���� ��������������� ������ ���, �� ��� ����� ������ ����� �������� ���� �� ����� �����
        if (!strlen($alternative_text))
        {
            $body = "Content-Type: ".$text_html."; charset=".$this->charset."\r\n";
            $body.="Content-Transfer-Encoding: ".$this->ctencoding."\r\n\r\n";
            $body.=$text;
        }
        // � ���� ���� ������������� ����� � ��� html
        // ������ ��� ����� ������ ����� �������� �� ���� ������
        elseif (strlen($alternative_text) and $text_html == 'text/html')
        {
            // �������� � ��������� � ������� ��������� ��� ����� ��������� ������ ������, ���������� ����� ����� ����, ������� �������� ��������
            $body = "Content-Type: multipart/alternative; boundary=ALT-".$this->boundary."\r\n\r\n";

            $body.="--ALT-".$this->boundary."\r\n"; // ������ ��������� �����������
            $body.="Content-Type: text/plain; charset=".$this->charset."\r\n"; // ��������� ��� ������ ����� ��������� ������
            $body.="Content-Transfer-Encoding: ".$this->ctencoding."\r\n\r\n"; // ����������� 
            $body.=$alternative_text."\r\n"; // � ������ ��� �����

            $body.="--ALT-".$this->boundary."\r\n"; // ������ ����� ����������� � ������ html ������ ������
            $body.="Content-Type: text/html; charset=".$this->charset."\r\n"; // ��������� ��� html ������
            $body.="Content-Transfer-Encoding: ".$this->ctencoding."\r\n\r\n"; // �����������
            $body.=$text."\r\n"; // �����

            $body.="--ALT-".$this->boundary."--"; // � ������ ����������� �����������, ����������, ��� ��� ����� �����������
        }
        // � ��������� ������ ���������
        $this->SubBody[$resource]['body'][0] = $body; // ��� ���������� ������������ � ������� ������� ������� ������. ��� ���������� ������ ����� ���� ������. ������� ������ ����� ������������� ��� �����
    }

    /**
     * ����������� mime type ����� �� ����������
     * @param type $file
     * @return string
     */
    protected function mime_content_type($file)
    {
        $ext = strtolower(substr(strrchr(basename($file), '.'), 1));
        switch ($ext)
        {
            case 'jpg': return 'image/jpeg';
            case 'jpeg': return 'image/jpeg';
            case 'gif': return 'image/gif';
            case 'png': return 'image/png';
            case 'ico': return 'image/x-icon';
            case 'txt': return 'text/plain';

            default: return 'application/octet-stream';
        }
    }

    /**
     * ������������ �����
     * @param string $filename : ���� � �����, ������� ���� ���������
     * @param string $new_name_filename : �������� ��� �����. ���� ����� ����������� ���� ���������, �� ��� ��� ����� �� ������� �����
     * @param string $filetype : MIME-��� �����. ���� �� ������, ���������� ���������� �� ����������, ���� �� ������� ����� application/octet-stream
     * @param string $disposition �� ������ �������� ����������� ����. 'attachment' - ���� ����������� ��� ��������� ����, ���� ������ ���, ����� ���� ����� ������ ������, �������� ����� �������� ����������� ������ html ������, ����������� �� ����� ������������ ��� ������������� ����. ��� 'attachment' � ��������� ������ ���� ����� ������������� ���� � ��� ����� �������
     * @param string $resource ������-��� ������ ������� ��������� �����
     * @return boolean
     */
    public function Attach($filename, $new_name_filename = "", $filetype = "", $disposition = "", $resource = 'webi')
    {
        if (!strlen($resource))
            $resource = 'webi';

        if (!file_exists($filename))
        {
            return FALSE;
        }

        // �������� ��� �����        
        // ���� ��� ����� ���� � �������, �� ����� ��� �� ����, � ��������� ������ ��� ����� ����� �� ��������� ���� 
        if (strlen($new_name_filename))
            $basename = basename($new_name_filename); // ���� ���� ������ ��� �����, �� ��� ����� �����
        else
            $basename = basename($filename); // � ���� ��� ������� ����� �����, �� ��� ����� ��������� �� ������ ������������ �����

        $charset_name = "=?".$this->charset."?B?".base64_encode($basename)."?=";


// ���� ��� ����� �� ������, �������� ���������� mime �� ����������
        if (!strlen($filetype))
            $filetype = $this->mime_content_type($basename);

        // �������� ����������� ��������� ����� ������
        // ������� ��������� ��� ���� �����, ��������� mime ����� � ���
        $body = "Content-Type: ".$filetype."; name=\"$charset_name\"\r\n";

        $body.="Content-Transfer-Encoding: base64\r\n";

        if ($disposition == 'attachment') // ���� ���� �������� ������ ������������
        {

            $body.="Content-Disposition: attachment; filename=\"$charset_name\"\r\n"; // ��������� ���������, ��� ���� ���������� � ������
        }

        $body.="Content-ID: <".$basename.">\r\n"; // id �����, ����� � ���� ����� ���� ���������� �� html

        $body.="\r\n";

        // ������ ����
        $body.=chunk_split(base64_encode(file_get_contents($filename)));

        // ���� ���� ���������� � ������, ��������� ��� ���� � ������ ��� ���������� ����������
        if ($disposition == 'attachment')
            $this->SubBody[$resource]['mixed'][] = $body;
        // � ���� ���� ����������, ������ ��������� ��� � ������ ������ ����
        else
        {
            // ���������� ���� ��������� �� ���� ������� � ����� ���� ������, ������� ��������� ��� �� ������� $this->count_body, ����� �� ���������� �� ��������� ����� ������
            $this->SubBody[$resource]['body'][$this->count_body] = $body;
            $this->count_body++; // ����������� �������
        }
    }

    /**
     * �������� ������
     * @param string $resource ������-��� ������ ������� ��������� ���������� ������.
     */
    public function BuildMail($resource = 'webi')
    {
        if (!strlen($resource))
            $resource = 'webi';

        $this->ready_headers[$resource] = ''; // ������� ��������� ��� �������
        // ������ �� ������ �������� � ��� ����� ����
        // ���� ���� ���� ��� �������� ��������, ������ ����� �������� � ���� ���������
        // � ���� ��� ��������������� ���� ��� ����� ��������, ������ ����� ����� ���� �� ������� �� ���������
        if (isset($this->SubBody[$resource]['body']))
            $resource_body = $resource;
        else
            $resource_body = 'webi';


        if (!is_array($this->sendto[$resource]) OR !count($this->sendto[$resource]))
        {
            $this->status_mail['status'] = false;
            $this->status_mail['message'] = "������ : �� ������� ���������� � �������� ".$resource;
            // return false;
        }



        // ���� ���� ������ �� ����� �������� ��� ���� ������������� �����, 
        // �� �� ����� ��� �������� ��������, ��� ��� ����� ������ ��� ���� ������� � �������� ��� �� �������, �� � ����� ��������, ���� ��� ��� ����
        // � ������� ��� ����� ����, ���� ��� �������� ������� ��� ����� ��� ������������, ������� ����� �� webi, �������������� �����
        if (!isset($this->body[$resource_body]))
        {
            // ���� �������� ����� ������ ������� ����� ��� �� ����� �����, ������ ��� ��� ����� �������� ����� ����� ����� ������
            // ��������� �� � ��������� ��� ������� Content-Type: multipart/related

            if (count($this->SubBody[$resource_body]['body']) > 1)
            {
                $body = implode("\r\n--REL-".$this->boundary."\r\n", $this->SubBody[$resource_body]['body']);
                $body = "Content-Type: multipart/related; boundary=REL-".$this->boundary."\r\n\r\n"
                        .'--REL-'.$this->boundary."\r\n".$body.'--REL-'.$this->boundary."--";
            }
            // � ���� � �������� ����� ������ ���� ���� �����
            else
            {
                $body = $this->SubBody[$resource_body]['body'][0];
            }

            // � ���� ��� �������������� ����� �����, ������� �������� ���� �� ����, �������� ������������� �����, � �� ����������
            // ����� ��������� ��� ����� � ��������� mixed � �������������� ���� ��������� $body ����� ����� �� ������
            if (isset($this->SubBody[$resource_body]['mixed']) AND count($this->SubBody[$resource_body]['mixed']))
            {
                $bodymix = implode('--MIX-'.$this->boundary."\r\n", $this->SubBody[$resource_body]['mixed']);
                $body = $body."\r\n--MIX-".$this->boundary."\r\n".$bodymix;
                $body = "Content-Type: multipart/mixed; boundary=MIX-".$this->boundary."\r\n\r\n"
                        .'--MIX-'.$this->boundary."\r\n".$body.'--MIX-'.$this->boundary."--";
            }
            unset($this->SubBody[$resource_body]); // ������ ������, �� ����� ���� ����� �� �������
            // ������ ����� ��������� �������� ��������� �� ������, ��� ��� �� ������ ������������ ��� ������� �� ��� ������
            $temp_mass = explode("\r\n\r\n", $body); // ��������� ���� �� ��������� �����.
            $this->body_header[$resource_body] = $temp_mass[0]; // ������ ������� � ����� �������� ���������, ��� ������� � ����� ����� ����������
            unset($temp_mass[0]); // ������ ������� ���� ���� ������� �� �������
            $this->body[$resource_body] = implode("\r\n\r\n", $temp_mass); // � ��������� ���� ������ ������� �� ��� ��� ��������� ��������� � ����� ��������� ��� � �������� ����������
            unset($temp_mass); // � ������� ��������� ������
            unset($body); // � ������ ����� ����, ��� ��� ����� ������ ��������, � ������ ��� ��������� ��������
        }


        // ������ ��������� ���������       
        // �������� ��������� TO.
        // ���������� ���� � �������
        $temp_mass = array();
        foreach ($this->sendto[$resource] as $key => $value)
        {

            if (strlen($this->names_email[$resource]['To'][$value]))
                $temp_mass[] = "=?".$this->charset."?Q?".str_replace("+", "_", str_replace("%", "=", urlencode(strtr($this->names_email[$resource]['To'][$value], "\r\n", "  "))))."?= <".$value.">";
            else
                $temp_mass[] = $value;
        }

        $this->headers[$resource]['To'] = implode(", ", $temp_mass); // ���� ��������� ����� �� ����� ��� �������� ����� mail()

        if (isset($this->acc[$resource]) and count($this->acc[$resource]) > 0)
            $this->headers[$resource]['CC'] = implode(", ", $this->acc[$resource]);

        if (isset($this->abcc[$resource]) and count($this->abcc[$resource]) > 0)
            $this->headers[$resource]['BCC'] = implode(", ", $this->abcc[$resource]);  // ���� ��������� ����� �� ����� ��� �������� ����� smtp



            
// ���� ����������� ������������� � ��������, ����� ����� ���� ����� ����������� �� ����� ��� ������, ���� �� From
        if ($this->receipt)
        {
            if (isset($this->headers["Reply-To"]))
                $this->headers["Disposition-Notification-To"] = $this->headers["Reply-To"];
            else
                $this->headers["Disposition-Notification-To"] = $this->headers['From'];
        }

        if ($this->charset != "")
        {
            $this->headers["Mime-Version"] = "1.0";
        }
        $this->headers["X-Mailer"] = "Php_libMail_v_2.0(webi.ru)";

        // ���� ��� �������� ������� ���� �� �����������, �� ����������� ��� ������� �� ���������, ������� ���� �� ����
        if (!isset($this->headers[$resource]['Subject']) and isset($this->headers['webi']['Subject']))
            $this->headers[$resource]['Subject'] = $this->headers['webi']['Subject'];

        // ������ ��� ������� ��������� �� ��������������� ������� ����������
        // �������� ���������� ���� �������� ���� ����� smtp
        if ($this->smtp['on'])
        {

            // ��������� (FROM - �� ����) �� ����� � �����. ����� ����������� � ���������
            $user_domen = explode('@', $this->headers['From']);

            $this->ready_headers[$resource] .= "Date: ".date("r")."\r\n";
            $this->ready_headers[$resource] .= "Message-ID: <".rand().".".$resource.date("YmjHis")."@".$user_domen[1].">\r\n"; // � id ������ ������� �� ������ ������ ��� � �������, ��� ��� ������������ ����� � ������� �������� � ���� ������� ����� ������������ ���������� id �����
            // ��� ��� ������ � ����������� ������ �� ������ ������� (�������� TO �� ������ ������ �����������, ������ �������, � FROM � ������ ������, ��� ��� FROM �������� �� ������� �� ������ ����)
            // ������� ������� ��������� ������ ����������� � ����� �������, ��� ����������� ��������
            // ������� ���������� ��������� ��� �������
            foreach ($this->headers[$resource] as $key => $value)
            {
                $new_mass_head[$key] = $value;
            }
            // � ������ ���������� ��������� �����, ������� �� ������� �� ������� 
            // � ���� ��������� �� ������(�� ����� ��������� �����������), ����� �� ���� ������
            foreach ($this->headers as $key => $value)
            {
                if (!is_array($value))
                    $new_mass_head[$key] = $value;
            }
            reset($new_mass_head);

            // � ������ ��� ��������� ������� ���������
            while (list( $hdr, $value ) = each($new_mass_head))
            {
                if ($hdr == "From" and strlen($this->names_email['from']))
                    $this->ready_headers[$resource] .= $hdr.": =?".$this->charset."?Q?".str_replace("+", "_", str_replace("%", "=", urlencode(strtr($this->names_email['from'], "\r\n", "  "))))."?= <".$value.">\r\n";
                elseif ($hdr == "Reply-To" and strlen($this->names_email['Reply-To']))
                    $this->ready_headers[$resource] .= $hdr.": =?".$this->charset."?Q?".str_replace("+", "_", str_replace("%", "=", urlencode(strtr($this->names_email['Reply-To'], "\r\n", "  "))))."?= <".$value.">\r\n";
                elseif ($hdr != "BCC")
                    $this->ready_headers[$resource] .= $hdr.": ".$value."\r\n"; // ���������� ��������� ��� �������� ������� �����
            }
        }
        // �������� �����������, ���� �������� ���� ����� mail()
        else
        {

            // ����� ��� �� ��� � ���� ������� ����� ������������� ������ �� ���� �������� ������� �����������- �����(������ �������) � ���������� ��� �������
            foreach ($this->headers[$resource] as $key => $value)
            {
                $new_mass_head[$key] = $value;
            }
            foreach ($this->headers as $key => $value)
            {
                if (!is_array($value))
                    $new_mass_head[$key] = $value;
            }
            reset($new_mass_head);
            while (list( $hdr, $value ) = each($new_mass_head))
            {
                if ($hdr == "From" and strlen($this->names_email['from']))
                    $this->ready_headers[$resource] .= $hdr.": =?".$this->charset."?Q?".str_replace("+", "_", str_replace("%", "=", urlencode(strtr($this->names_email['from'], "\r\n", "  "))))."?= <".$value.">\r\n";
                elseif ($hdr == "Reply-To" and strlen($this->names_email['Reply-To']))
                    $this->ready_headers[$resource] .= $hdr.": =?".$this->charset."?Q?".str_replace("+", "_", str_replace("%", "=", urlencode(strtr($this->names_email['Reply-To'], "\r\n", "  "))))."?= <".$value.">\r\n";
                elseif ($hdr != "Subject" and $hdr != "To")
                    $this->ready_headers[$resource] .= "$hdr: $value\r\n"; // ���������� ��������� ���� � ����... ��� ��������� ����
            }
        }
        // � � ���������� ������� ��������� �� ������, ���������� �����. ��� ����� ��������� ��� ����
        $this->ready_headers[$resource].=$this->body_header[$resource_body]."\r\n";
    }

    /**
     * ��������� ���������� �������� ���������� email �� ��������� �������� ��������
     * @param boolean $bool
     */
    public function autoCheck($bool)
    {
        if ($bool)
            $this->checkAddress = true;
        else
            $this->checkAddress = false;
    }

    /**
     * �������������� ��������� ���������� ����� ����
     * @param boolean $bool
     */
    public function log_on($bool)
    {
        if ($bool)
            $this->log_on = true;
        else
            $this->log_on = false;
    }

    /**
     * ���� ������
     * @param string $subject
     * @param string $resource ������-��� ������ ������� ��������� ������ ����, �����, ���� ��� ������� �� ����� ����������� ����, ��� ��������� �� ������� �� ���������
     */
    public function Subject($subject, $resource = 'webi')
    {
        if (!strlen($resource))
            $resource = 'webi';

        $this->headers[$resource]['Subject'] = "=?".$this->charset."?Q?".str_replace("+", "_", str_replace("%", "=", urlencode(strtr($subject, "\r\n", "  "))))."?=";
    }

    /**
     * �� ����
     * @param string $from ����� ���� ��� � email ����� ����������� ���;asd@asde.ru ���� ������ email. From �� ���� �������� ����������, ��� ������ ���������� ��� ������� ������
     * @return boolean
     */
    public function From($from)
    {
        if (!is_string($from))
        {
            $this->status_mail['status'] = false;
            $this->status_mail['message'] = "������, From ������ ���� �������";
            return FALSE;
        }

        $temp_mass = explode(';', $from); // ��������� �� ����������� ��� ��������� �����
        if (count($temp_mass) == 2) // ���� ������� ������� �� ��� ��������
        {
            $this->names_email['from'] = $temp_mass[0]; // ��� ������ �����
            $this->headers['From'] = $temp_mass[1]; // ����� ������ �����
        }
        else // � ���� ��� �� ����������
        {
            $this->names_email['from'] = '';
            $this->headers['From'] = $from;
        }
    }

    /**
     * �� ����� ����� ��������
     * @param string $address ������ ���������� ��� ������� ������� ������, �������� ����� ����� ������ ������ �� ���� �����
     * @return boolean
     */
    public function ReplyTo($address)
    {

        if (!is_string($address))
            return false;

        $temp_mass = explode(';', $address); // ��������� �� ����������� ��� ��������� �����

        if (count($temp_mass) == 2) // ���� ������� ������� �� ��� ��������
        {
            $this->names_email['Reply-To'] = $temp_mass[0]; // ��� ������ �����
            $this->headers['Reply-To'] = $temp_mass[1]; // ����� ������ �����
        }
        else // � ���� ��� �� ����������
        {
            $this->names_email['Reply-To'] = '';
            $this->headers['Reply-To'] = $address;
        }
    }

    /**
     * ���������� ��������� ��� ��������� ����������� � ���������. �������� ����� ������� �� "From" (��� �� "ReplyTo" ���� ������)
     * ������ �������� �� ��������, ��� ��� ������ ��������� ���������� ���� ��������, � ��������� �������� ������� ����������� ������ � ���� ���������� ��� ����, ��� ��� ���� �������� ����� ������������ ������� ��� �������� ������� �������
     */
    public function Receipt()
    {
        $this->receipt = 1;
    }

    /**
     * ���� ����������. 
     * @param string|array $to
     * @param string $resource ������-������ ������� ����������� �������.
     */
    public function To($to, $resource = 'webi')
    {
        if (!strlen($resource))
            $resource = 'webi';

        // ���� ��� ������
        if (is_array($to))
        {
            foreach ($to as $key => $value) // ���������� ������ � ��������� � ������ ��� �������� ����� smtp
            {

                $temp_mass = explode(';', $value); // ��������� �� ����������� ��� ��������� �����

                if (count($temp_mass) == 2) // ���� ������� ������� �� ��� ��������
                {
                    $this->smtpsendto[$resource][$temp_mass[1]] = $temp_mass[1]; // ����� � �������� ����������, ����� ��������� ����� �������
                    $this->names_email[$resource]['To'][$temp_mass[1]] = $temp_mass[0]; // ��� ������ �����
                    $this->sendto[$resource][] = $temp_mass[1];
                }
                else // � ���� ��� �� ����������
                {
                    $this->smtpsendto[$resource][$value] = $value; // ����� � �������� ����������, ����� ��������� ����� �������
                    $this->names_email[$resource]['To'][$value] = ''; // ��� ������ �����
                    $this->sendto[$resource][] = $value;
                }
            }
        }
        else
        {
            $temp_mass = explode(';', $to); // ��������� �� ����������� ��� ��������� �����

            if (count($temp_mass) == 2) // ���� ������� ������� �� ��� ��������
            {

                $this->sendto[$resource][] = $temp_mass[1];
                $this->smtpsendto[$resource][$temp_mass[1]] = $temp_mass[1]; // ����� � �������� ����������, ����� ��������� ����� �������
                $this->names_email[$resource]['To'][$temp_mass[1]] = $temp_mass[0]; // ��� ������ �����
            }
            else // � ���� ��� �� ����������
            {
                $this->sendto[$resource][] = $to;
                $this->smtpsendto[$resource][$to] = $to; // ����� � �������� ����������, ����� ��������� ����� �������

                $this->names_email[$resource]['To'][$to] = ''; // ��� ������ �����
            }
        }

        // �������� ������� �� ����������
        if ($this->checkAddress == true)
            $this->CheckAdresses($this->sendto[$resource]);
    }

    private function CheckAdresses($aad)
    {
        foreach ($aad as $key => $value)
        {
            if (!$this->ValidEmail($value))
            {
                $this->status_mail['status'] = false;
                $this->status_mail['message'] = "������ : �� ������ email ".$value;
                return FALSE;
            }
        }
    }

    public function ValidEmail($address)
    {

        // ���� ���������� ����������� ������� ���������� ������, �� ��������� ����� ���� ��������. ��������� � php 5.2
        if (function_exists('filter_list'))
        {
            $valid_email = filter_var($address, FILTER_VALIDATE_EMAIL);
            if ($valid_email !== false)
                return true;
            else
                return false;
        }
        else // � ���� php ��� ������ ������, �� �������� ���������� ������ ������ ��������
        {
            if (ereg(".*<(.+)>", $address, $regs))
            {
                $address = $regs[1];
            }
            if (ereg("^[^@  ]+@([a-zA-Z0-9\-]+\.)+([a-zA-Z0-9\-]{2}|net|com|gov|mil|org|edu|int)\$", $address))
                return true;
            else
                return false;
        }
    }

    /**
     * ��������� ��������� CC ( �������� �����, ��� ���������� ����� ������ ���� ���� ����� )
     * @param array|string $cc
     * @param string $resource ������-��� �������� ����� ����������� �������� �����. ���� �� ���������� ��� �������, �� ������������� ������ �� �����, �� ������� �� ��������� ����� ������ �� �����
     */
    public function Cc($cc, $resource = 'webi')
    {
        if (!strlen($resource))
            $resource = 'webi';

        if (is_array($cc))
        {
            foreach ($cc as $key => $value) // ���������� ������ � ��������� � ������ ��� �������� ����� smtp
            {
                $this->smtpsendto[$resource][$value] = $value; // ����� � �������� ����������, ����� ��������� ����� �������
                $this->acc[$resource][$value] = $value;
            }
        }
        else
        {
            $this->acc[$resource][$cc] = $cc;
            $this->smtpsendto[$resource][$cc] = $cc; // ����� � �������� ����������, ����� ��������� ����� �������
        }

        if ($this->checkAddress == true)
            $this->CheckAdresses($this->acc[$resource]);
    }

    /**
     * ������� �����. �� ����� �������� ��������� ���� ���� ������
     * @param string|array $bcc
     * @param string $resource ������-��� �������� ����� ����������� ������� �����. ���� �� ���������� ��� �������, �� ������������� ������ �� �����, �� ������� �� ��������� ����� ������ �� �����
     */
    public function Bcc($bcc, $resource = 'webi')
    {
        if (!strlen($resource))
            $resource = 'webi';

        if (is_array($bcc))
        {
            foreach ($bcc as $key => $value) // ���������� ������ � ��������� � ������ ��� �������� ����� smtp
            {
                $this->smtpsendto[$resource][$value] = $value; // ����� � �������� ����������, ����� ��������� ����� �������
                $this->abcc[$resource][$value] = $value;
            }
        }
        else
        {
            $this->abcc[$resource][$bcc] = $bcc;
            $this->smtpsendto[$resource][$bcc] = $bcc; // ����� � �������� ����������, ����� ��������� ����� �������
        }

        if ($this->checkAddress == true)
            $this->CheckAdresses($this->abcc[$resource]);
    }

    /**
     * ���������� �����������
     * @param string $org
     */
    public function Organization($org)
    {
        if (trim($org != ""))
            $this->headers['Organization'] = $org;
    }

    /**
     * ��������� ����������
     * @param int $priority
     * @return boolean
     */
    public function Priority($priority)
    {
        $priorities = array('1 (Highest)', '2 (High)', '3 (Normal)', '4 (Low)', '5 (Lowest)');
        if (!intval($priority))
            return false;

        if (!isset($priorities[$priority - 1]))
            return false;

        $this->headers["X-Priority"] = $priorities[$priority - 1];

        return true;
    }

    /**
     * ��������� �������� ����� smtp ��������� ������
     * ����� ������� ���� ������� �������� ����� smtp ��������
     * ��� �������� ����� ���������� ���������� ������ ����� ��������� � ����������� "ssl://" �������� ��� "ssl://smtp.gmail.com"
     * @param string $smtp_serv
     * @param string $login
     * @param string $pass
     * @param int $port
     * @param int $timeout
     */
    public function smtp_on($smtp_serv, $login, $pass, $port = 25, $timeout = 5)
    {
        $this->smtp['on'] = true; // �������� �������� ����� smtp
        $this->smtp['serv'] = $smtp_serv;
        $this->smtp['login'] = $login;
        $this->smtp['pass'] = $pass;
        $this->smtp['port'] = $port;
        $this->smtp['timeout'] = $timeout;
    }

    private function get_data($smtp_conn)
    {
        $data = "";
        while ($str = fgets($smtp_conn, 515))
        {
            $data .= $str;
            if (substr($str, 3, 1) == " ")
            {
                break;
            }
        }
        return $data;
    }

    private function add_log($text)
    {
        // ���� ������������ ���� ��������, ����� ��������� � ���
        if ($this->log_on)
            $this->smtp_log.=$text;
    }

    public function Send()
    {
        // ���� ���-�� � ������ ���� ������, �� ������������ �� �����
        if (!$this->status_mail['status'])
        {
            return FALSE;
        }



        // ���� �������� ��� ������������� smtp
        if (!$this->smtp['on'])
        {
             
            // ���������� ������ "���� ����������", �� ������ ������� �������, �� ���� ��������� ������� � ��� ������� ������� ���������� �������� ���������� ������
            foreach ($this->sendto as $key => $value)
            {
                $strTo = implode(", ", $this->sendto[$key]);
                // �������� ������ ��� �������� �������
                $this->BuildMail($key);
                // ����� ������ ������ ��� �������� ������ ������
                if (!$this->status_mail['status'])
                {
                    return FALSE;
                }


                // ���� ���� ��� ������� ������� �������������, ������ ������� ������� ��� ���� �� �������� �������
                if (isset($this->body[$key]))
                    $body_resource = $key;
                // � ���� ���� ��� �������� ������� �� �������������, ����� �������� � ����� �� ������� �� ���������
                else
                    $body_resource = 'webi';

                // ����������, ��������� ����� �� �������� ��������, � ���� �� ������� ������� ��� ������ ����, �� �������� ��� �� �� ���������
                $res = @mail($strTo, $this->headers[$key]['Subject'], $this->body[$body_resource], $this->ready_headers[$key]);

                // ���� ���� ������ ��� ��������
                if (!$res)
                {
                    $this->status_mail['status'] = false;
                    $this->status_mail['message'] = "������ : ������� mail() ������� ������";
                }
                // � ���� ������ �� ���� � ������ �������� ���� ��� �������������...
                // �����, ���� � ���������� ���� ���� ������, � ��� ��� ������, �� ������ ��������� � true
                // � ����� ����� ������ ��� � �������� ���� ���� ��� ���� ������ ��������
                elseif ($this->status_mail['status'])
                {

                    $this->add_log('TO: '.$strTo."\n");
                    $this->add_log("Subject: ".$this->headers[$key]['Subject']."\n");
                    $this->add_log($this->ready_headers[$key]."\n\n");
                    $this->add_log($this->body[$body_resource]."\n\n\n");


                    $this->status_mail['status'] = true;
                    $this->status_mail['message'] = "������ ������� ���������� � ������� mail()";
                }
                if ($key != 'webi')
                {   // ���� ������� ������ �� �������� �������� �� ���������, ������ ��������� ����� �������, ��� ��� ��� ��� �� �����
                    // � ��� ��������� �� ������� �� ��������� ��� ����� ������������
                    unset($this->headers[$key]);
                    unset($this->ready_headers[$key]);
                }
                // ���� ������ ��� ���� �� �������� �������� �� ���������, ������ ���� ����� �������, ��� ��� �� ������������
                // � ��� ���� ������� �� ��������� ��� ����� ������������
                if ($body_resource != 'webi')
                {
                    unset($this->body[$body_resource]);
                }
            }

            if ($this->status_mail['status'])
            {
                return true;
            }
            else
            {
                return FALSE;
            }
        }
        else // ���� ����� smtp
        {

            // ���� ��� ���� �� ������ �� �������� ������ ��� ��������, ������� � �������
            if (!$this->smtp['serv'] OR !$this->smtp['login'] OR !$this->smtp['pass'] OR !$this->smtp['port'])
            {
                $this->status_mail['status'] = false;
                $this->status_mail['message'] = "������ : �� ��� ������������ ������ ��� SMTP �������";
                return false;
            }


// ��������� (FROM - �� ����) �� ����� � �����. ���� ����������� � ���������� � ������
            $user_domen = explode('@', $this->headers['From']);


            $smtp_conn = fsockopen($this->smtp['serv'], $this->smtp['port'], $errno, $errstr, $this->smtp['timeout']);
            if (!$smtp_conn)
            {
                $this->add_log("���������� � �������� �� ������\n\n");
                fclose($smtp_conn);
                $this->status_mail['status'] = false;
                $this->status_mail['message'] = "������: ���������� � �������� �� ������";
                return false;
            }

            $data = $this->get_data($smtp_conn)."\n";
            $this->add_log($data);

            fputs($smtp_conn, "EHLO ".$user_domen[0]."\r\n");
            $this->add_log("�: EHLO ".$user_domen[0]."\n");
            $data = $this->get_data($smtp_conn)."\n";
            $this->add_log($data);
            $code = substr($data, 0, 3); // �������� ��� ������

            if ($code != 250)
            {
                $this->add_log("������ ���������� EHLO \n");
                fclose($smtp_conn);
                $this->status_mail['status'] = false;
                $this->status_mail['message'] = "������ ���������� EHLO";
                return false;
            }

            fputs($smtp_conn, "AUTH LOGIN\r\n");
            $this->add_log( "�: AUTH LOGIN\n");
            $data = $this->get_data($smtp_conn)."\n";
            $this->add_log($data);
            $code = substr($data, 0, 3);

            if ($code != 334)
            {
                $this->add_log("������ �� �������� ������ ����������� \n");
                fclose($smtp_conn);
                $this->status_mail['status'] = false;
                $this->status_mail['message'] = "������ �� �������� ������ �����������";
                return false;
            }

            fputs($smtp_conn, base64_encode($this->smtp['login'])."\r\n");
            $this->add_log( "�: ".base64_encode($this->smtp['login'])."\n");
            $data = $this->get_data($smtp_conn)."\n";
            $this->add_log($data);
            $code = substr($data, 0, 3);
            if ($code != 334)
            {
                $this->add_log( "������ ������� � ������ �����\n");
                fclose($smtp_conn);
                $this->status_mail['status'] = false;
                $this->status_mail['message'] = "������ ������� � ������ ����� ����� SMTP";
                return false;
            }


            fputs($smtp_conn, base64_encode($this->smtp['pass'])."\r\n");
            //$this->add_log("�: ". base64_encode($this->smtp_pass)."\n"); // ��� ������ ����������� ����� ����� � �����
            $this->add_log("�: parol_skryt\n"); // � ��� ������ ����� � �����
            $data = $this->get_data($smtp_conn)."\n";
            $this->add_log($data);
            $code = substr($data, 0, 3);
            if ($code != 235)
            {
                $this->add_log("�� ���������� ������\n");
                fclose($smtp_conn);
                $this->status_mail['status'] = false;
                $this->status_mail['message'] = "�� ���������� ������ ��� SMTP";
                return false;
            }

            // � ������ ���������� �������, ����� ��������� ������ ������ ��������� �������
            // ���������� ������� �������
            foreach ($this->smtpsendto as $key_res => $value_res)
            {
                // ���� ������ �� �������� �������
                $this->BuildMail($key_res);
                // ����� ������ ������ ��� �������� ������ ������
                if (!$this->status_mail['status'])
                {
                    return FALSE;
                }

                // ���� ��� �������� ������� ���� ����, �� ������ ��� ���� ������
                if (isset($this->body[$key_res]))
                    $body_resource = $key_res;
                // � ���� ��� �������� ������� ��� ����, ������ ������ ��� ���� �� ���������
                else
                    $body_resource = 'webi';

                // �������� �������� ���������� ������
                fputs($smtp_conn, "MAIL FROM:<".$this->headers['From']."> SIZE=".strlen($this->ready_headers[$key_res]."\r\n".$this->body[$body_resource])."\r\n");
                $this->add_log("�: MAIL FROM:<".$this->headers['From']."> SIZE=".strlen($this->ready_headers[$key_res]."\r\n".$this->body[$body_resource])."\n");
                $data = $this->get_data($smtp_conn)."\n";
                $this->add_log($data); 
                
                $code = substr($data, 0, 3);
                if ($code != 250)
                {
                    $this->add_log("������ ������� � ������� MAIL FROM\n");
                    fclose($smtp_conn);
                    $this->status_mail['status'] = false;
                    $this->status_mail['message'] = "������ ������� � ������� MAIL FROM ����� SMTP";
                    return false;
                }



                foreach ($this->smtpsendto[$key_res] as $keywebi => $valuewebi)
                {
                    fputs($smtp_conn, "RCPT TO:<".$valuewebi.">\r\n");
                    $this->add_log("�: RCPT TO:<".$valuewebi.">\n");
                    $data = $this->get_data($smtp_conn)."\n";
                    $this->add_log($data);
                    $code = substr($data, 0, 3);
                    if ($code != 250 AND $code != 251)
                    {
                        $this->add_log( "������ �� ������ ������� RCPT TO\n");
                        fclose($smtp_conn);
                        $this->status_mail['status'] = false;
                        $this->status_mail['message'] = "������ �� ������ ������� RCPT ����� SMTP";
                        return false;
                    }
                }

                fputs($smtp_conn, "DATA\r\n");
                $this->add_log("�: DATA\n");
                $data = $this->get_data($smtp_conn)."\n";
                $this->add_log($data);
                
                $code = substr($data, 0, 3);
                if ($code != 354)
                {
                    $this->add_log( "������ �� ������ DATA\n");
                    fclose($smtp_conn);
                    $this->status_mail['status'] = false;
                    $this->status_mail['message'] = "������ �� ������ ������� DATA ���� SMTP";
                    return false;
                }

                fputs($smtp_conn, $this->ready_headers[$key_res]."\r\n".$this->body[$body_resource]."\r\n.\r\n");
                $this->add_log("�: ".$this->ready_headers[$key_res]."\r\n".$this->body[$body_resource]."\r\n.\r\n");
                $data = $this->get_data($smtp_conn)."\n";
                $this->add_log($data);

                $code = substr($data, 0, 3);
                if ($code != 250)
                {
                    $this->add_log("������ �������� ������\n");
                    fclose($smtp_conn);
                    $this->status_mail['status'] = false;
                    $this->status_mail['message'] = "������ �������� ������ ����� SMTP";
                    return false;
                }

                fputs($smtp_conn, "RSET\r\n"); // ����� ������ ����� ����, ��� ���� ������� �������, ����� ����� ���� ��������� ��� ������ � ��������� ���� ����� 
                $this->add_log("�: RSET\n");
                $data = $this->get_data($smtp_conn)."\n";
                $this->add_log($data);

                $code = substr($data, 0, 3);
                if ($code != 250)
                {
                    $this->add_log("������ �������� ������\n");
                    fclose($smtp_conn);
                    $this->status_mail['status'] = false;
                    $this->status_mail['message'] = "������ �� ������ ������� RSET";
                    return false;
                }

                // ���� ������ �� �������� �������� �� ���������, ������ ��������� ����� �������, ��� ��� �� �����������, � ��� ��������� ������� �� ��������� ����� ������������                
                if ($key_res != 'webi')
                {
                    unset($this->headers[$key_res]);
                    unset($this->ready_headers[$key_res]);
                }
                // ���� ������ ��� ���� �� �������� �������� �� ���������, ������ ���� ����� �������, ��� ��� �� �����, � ��� ���� ������� �� ��������� ��� ����� ������������
                if ($body_resource != 'webi')
                {
                    unset($this->body[$body_resource]);
                }
            }
            // ����� ��������� ���� �������� �������� �����
            fputs($smtp_conn, "QUIT\r\n");
            $this->add_log("QUIT\r\n");
            $data = $this->get_data($smtp_conn)."\n";
            $this->add_log($data);
            fclose($smtp_conn);

            $this->status_mail['status'] = true;
            $this->status_mail['message'] = "������ ������� ���������� � ������� SMTP";
            return true;
        }
    }

    public function Get()
    {
        if (!$this->log_on)
            return '������������ ���� ���������. ����� ��� ������������ ����� �������� ��� $m->log_on(true);';
        
        if (strlen($this->smtp_log))
        {
            return $this->smtp_log; // ���� ���� ��� �������� ������� ���   
        }
    }

}

?>
