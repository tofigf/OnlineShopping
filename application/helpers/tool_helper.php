<?php
function seflink($str, $options = array())
{
    $str = mb_convert_encoding((string)$str, 'UTF-8', mb_list_encodings());
    $defaults = array(
        'delimiter' => '-',
        'limit' => null,
        'lowercase' => true,
        'replacements' => array(),
        'transliterate' => true
    );
    $options = array_merge($defaults, $options);
    $char_map = array(
        // Latin
        'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A', 'Å' => 'A', 'Æ' => 'AE', 'Ç' => 'C',
        'È' => 'E', 'É' => 'E', 'Ê' => 'E', 'Ë' => 'E', 'Ì' => 'I', 'Í' => 'I', 'Î' => 'I', 'Ï' => 'I',
        'Ð' => 'D', 'Ñ' => 'N', 'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O', 'Ö' => 'O', 'Ő' => 'O',
        'Ø' => 'O', 'Ù' => 'U', 'Ú' => 'U', 'Û' => 'U', 'Ü' => 'U', 'Ű' => 'U', 'Ý' => 'Y', 'Þ' => 'TH',
        'ß' => 'ss',
        'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a', 'ä' => 'a', 'å' => 'a', 'æ' => 'ae', 'ç' => 'c',
        'è' => 'e', 'é' => 'e', 'ê' => 'e', 'ë' => 'e', 'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i',
        'ð' => 'd', 'ñ' => 'n', 'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o', 'ö' => 'o', 'ő' => 'o',
        'ø' => 'o', 'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ü' => 'u', 'ű' => 'u', 'ý' => 'y', 'þ' => 'th',
        'ÿ' => 'y',
        // Latin symbols
        '©' => '(c)',
        // Greek
        'Α' => 'A', 'Β' => 'B', 'Γ' => 'G', 'Δ' => 'D', 'Ε' => 'E', 'Ζ' => 'Z', 'Η' => 'H', 'Θ' => '8',
        'Ι' => 'I', 'Κ' => 'K', 'Λ' => 'L', 'Μ' => 'M', 'Ν' => 'N', 'Ξ' => '3', 'Ο' => 'O', 'Π' => 'P',
        'Ρ' => 'R', 'Σ' => 'S', 'Τ' => 'T', 'Υ' => 'Y', 'Φ' => 'F', 'Χ' => 'X', 'Ψ' => 'PS', 'Ω' => 'W',
        'Ά' => 'A', 'Έ' => 'E', 'Ί' => 'I', 'Ό' => 'O', 'Ύ' => 'Y', 'Ή' => 'H', 'Ώ' => 'W', 'Ϊ' => 'I',
        'Ϋ' => 'Y',
        'α' => 'a', 'β' => 'b', 'γ' => 'g', 'δ' => 'd', 'ε' => 'e', 'ζ' => 'z', 'η' => 'h', 'θ' => '8',
        'ι' => 'i', 'κ' => 'k', 'λ' => 'l', 'μ' => 'm', 'ν' => 'n', 'ξ' => '3', 'ο' => 'o', 'π' => 'p',
        'ρ' => 'r', 'σ' => 's', 'τ' => 't', 'υ' => 'y', 'φ' => 'f', 'χ' => 'x', 'ψ' => 'ps', 'ω' => 'w',
        'ά' => 'a', 'έ' => 'e', 'ί' => 'i', 'ό' => 'o', 'ύ' => 'y', 'ή' => 'h', 'ώ' => 'w', 'ς' => 's',
        'ϊ' => 'i', 'ΰ' => 'y', 'ϋ' => 'y', 'ΐ' => 'i',
        // Turkish
        'Ş' => 'S', 'İ' => 'I', 'Ç' => 'C', 'Ü' => 'U', 'Ö' => 'O', 'Ğ' => 'G',
        'ş' => 's', 'ı' => 'i', 'ç' => 'c', 'ü' => 'u', 'ö' => 'o', 'ğ' => 'g',
        // Russian
        'А' => 'A', 'Б' => 'B', 'В' => 'V', 'Г' => 'G', 'Д' => 'D', 'Е' => 'E', 'Ё' => 'Yo', 'Ж' => 'Zh',
        'З' => 'Z', 'И' => 'I', 'Й' => 'J', 'К' => 'K', 'Л' => 'L', 'М' => 'M', 'Н' => 'N', 'О' => 'O',
        'П' => 'P', 'Р' => 'R', 'С' => 'S', 'Т' => 'T', 'У' => 'U', 'Ф' => 'F', 'Х' => 'H', 'Ц' => 'C',
        'Ч' => 'Ch', 'Ш' => 'Sh', 'Щ' => 'Sh', 'Ъ' => '', 'Ы' => 'Y', 'Ь' => '', 'Э' => 'E', 'Ю' => 'Yu',
        'Я' => 'Ya',
        'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd', 'е' => 'e', 'ё' => 'yo', 'ж' => 'zh',
        'з' => 'z', 'и' => 'i', 'й' => 'j', 'к' => 'k', 'л' => 'l', 'м' => 'm', 'н' => 'n', 'о' => 'o',
        'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't', 'у' => 'u', 'ф' => 'f', 'х' => 'h', 'ц' => 'c',
        'ч' => 'ch', 'ш' => 'sh', 'щ' => 'sh', 'ъ' => '', 'ы' => 'y', 'ь' => '', 'э' => 'e', 'ю' => 'yu',
        'я' => 'ya',
        // Ukrainian
        'Є' => 'Ye', 'І' => 'I', 'Ї' => 'Yi', 'Ґ' => 'G',
        'є' => 'ye', 'і' => 'i', 'ї' => 'yi', 'ґ' => 'g',
        // Czech
        'Č' => 'C', 'Ď' => 'D', 'Ě' => 'E', 'Ň' => 'N', 'Ř' => 'R', 'Š' => 'S', 'Ť' => 'T', 'Ů' => 'U',
        'Ž' => 'Z',
        'č' => 'c', 'ď' => 'd', 'ě' => 'e', 'ň' => 'n', 'ř' => 'r', 'š' => 's', 'ť' => 't', 'ů' => 'u',
        'ž' => 'z',
        // Polish
        'Ą' => 'A', 'Ć' => 'C', 'Ę' => 'e', 'Ł' => 'L', 'Ń' => 'N', 'Ó' => 'o', 'Ś' => 'S', 'Ź' => 'Z',
        'Ż' => 'Z',
        'ą' => 'a', 'ć' => 'c', 'ę' => 'e', 'ł' => 'l', 'ń' => 'n', 'ó' => 'o', 'ś' => 's', 'ź' => 'z',
        'ż' => 'z',
        // Latvian
        'Ā' => 'A', 'Č' => 'C', 'Ē' => 'E', 'Ģ' => 'G', 'Ī' => 'i', 'Ķ' => 'k', 'Ļ' => 'L', 'Ņ' => 'N',
        'Š' => 'S', 'Ū' => 'u', 'Ž' => 'Z',
        'ā' => 'a', 'č' => 'c', 'ē' => 'e', 'ģ' => 'g', 'ī' => 'i', 'ķ' => 'k', 'ļ' => 'l', 'ņ' => 'n',
        'š' => 's', 'ū' => 'u', 'ž' => 'z'
    );
    $str = preg_replace(array_keys($options['replacements']), $options['replacements'], $str);
    if ($options['transliterate']) {
        $str = str_replace(array_keys($char_map), $char_map, $str);
    }
    $str = preg_replace('/[^\p{L}\p{Nd}]+/u', $options['delimiter'], $str);
    $str = preg_replace('/(' . preg_quote($options['delimiter'], '/') . '){2,}/', '$1', $str);
    $str = mb_substr($str, 0, ($options['limit'] ? $options['limit'] : mb_strlen($str, 'UTF-8')), 'UTF-8');
    $str = trim($str, $options['delimiter']);
    return $options['lowercase'] ? mb_strtolower($str, 'UTF-8') : $str;
}

function GetIP(){
  if(getenv("HTTP_CLIENT_IP")) {
  $ip = getenv("HTTP_CLIENT_IP");
  } elseif(getenv("HTTP_X_FORWARDED_FOR")) {
  $ip = getenv("HTTP_X_FORWARDED_FOR");
  if (strstr($ip, ',')) {
  $tmp = explode (',', $ip);
  $ip = trim($tmp[0]);
  }
  } else {
  $ip = getenv("REMOTE_ADDR");
  }
  return $ip;
}

function tarih($tarih){
  $tyeni = date('d-m-Y',strtotime($tarih));
  $ayarla = array(
    1 => "Yanvar",2 => "Fevral",3 => "Mart",4 => "Aprel",
    5 => "May",6 => "Iyun",7 => "Iyul",8 => "Avqust",
    9 => "Sentiyabr",10 => "Oktyabr",11 => "Noyabr",12 => "Dekabr",
  );
  $parcala = explode("-",$tyeni);
  $gun = $parcala[0];
  $ay  = $parcala[1];
  $yil = $parcala[2];
  $turkceay = $ayarla[$ay];

  $bitir = $gun.' '.$turkceay.' '.$yil;
  return $bitir;
}

 function cargoImg($id)
{
  $ci =& get_instance();
  $result = $ci->db->select('img')->from('cargo')->where('Id',$id)->get()->row();
  return $result->img;
}
function cargoTmb($id)
{
 $ci =& get_instance();
 $result = $ci->db->select('tmb')->from('cargo')->where('Id',$id)->get()->row();
 return $result->tmb;
}
function cargoMini($id)
{
 $ci =& get_instance();
 $result = $ci->db->select('mini')->from('cargo')->where('Id',$id)->get()->row();
 return $result->mini;
}
/////////////////////////////////
///bank
function bankImg($id)
{
 $ci =& get_instance();
 $result = $ci->db->select('img')->from('bank')->where('Id',$id)->get()->row();
 return $result->img;
}
function bankTmb($id)
{
$ci =& get_instance();
$result = $ci->db->select('tmb')->from('bank')->where('Id',$id)->get()->row();
return $result->tmb;
}
function bankMini($id)
{
$ci =& get_instance();
$result = $ci->db->select('mini')->from('bank')->where('Id',$id)->get()->row();
return $result->mini;
}
function cargoDesiCheck(){
  $ci =& get_instance();
  $result =$ci->db->select('*')->from('cargo')->where('status','1')->order_by('Id','asc')
  ->get()->result_array();
  return $result;
}
function cargoJoinTable(){
  $ci=& get_instance();
  $result =$ci->db->select('*')->from('cargo')
  ->join('cargodesi','cargodesi.cargoId =  cargo.Id','inner')
  ->order_by('cargodesi.Id','desc')->get()->result_array();
  return $result;
}
function categoriCheck(){
  $ci =& get_instance();
  $result = $ci->db->select('*')->from('categories')->order_by('Id','asc')->get()->result_array();

  return $result;
}
function productsJoinCategories(){
  $ci= & get_instance();
  $result =$ci->db->select('*')->from('categories')
  ->join('products','products.catId = categories.Id','inner')
  ->order_by('products.Id','desc')->get()->result_array();
  return $result;
}
///////////////////
///////////////
/////////////////
function productImg($id)
{
 $ci =& get_instance();
 $result = $ci->db->select('img')->from('products')->where('Id',$id)->get()->row();
 return $result->img;
}
function productTmb($id)
{
$ci =& get_instance();
$result = $ci->db->select('tmb')->from('products')->where('Id',$id)->get()->row();
return $result->tmb;
}
function productMini($id)
{
$ci =& get_instance();
$result = $ci->db->select('mini')->from('products')->where('Id',$id)->get()->row();
return $result->mini;
}
///////////////////////////////
function productImg2($id)
{
 $ci =& get_instance();
 $result = $ci->db->select('img2')->from('products')->where('Id',$id)->get()->row();
 return $result->img2;
}
function productTmb2($id)
{
$ci =& get_instance();
$result = $ci->db->select('tmb2')->from('products')->where('Id',$id)->get()->row();
return $result->tmb2;
}
function productMini2($id)
{
$ci =& get_instance();
$result = $ci->db->select('mini2')->from('products')->where('Id',$id)->get()->row();
return $result->mini2;
}
///////////////////////
function productImg3($id)
{
 $ci =& get_instance();
 $result = $ci->db->select('img3')->from('products')->where('Id',$id)->get()->row();
 return $result->img3;
}
function productTmb3($id)
{
$ci =& get_instance();
$result = $ci->db->select('tmb3')->from('products')->where('Id',$id)->get()->row();
return $result->tmb3;
}
function productMini3($id)
{
$ci =& get_instance();
$result = $ci->db->select('mini3')->from('products')->where('Id',$id)->get()->row();
return $result->mini3;
}
////////////////////////////
function productImg4($id)
{
 $ci =& get_instance();
 $result = $ci->db->select('img4')->from('products')->where('Id',$id)->get()->row();
 return $result->img4;
}
function productTmb4($id)
{
$ci =& get_instance();
$result = $ci->db->select('tmb4')->from('products')->where('Id',$id)->get()->row();
return $result->tmb4;
}
function productMini4($id)
{
$ci =& get_instance();
$result = $ci->db->select('mini4')->from('products')->where('Id',$id)->get()->row();

return $result->mini4;
}

function security(){
  $ci =& get_instance();
  $result =$ci->db->from('security')->get()->row_array();
  return $result;
}
function seller(){
  $ci =& get_instance();
  $result =$ci->db->from('sales')->get()->row_array();
  return $result;
}
function warranty(){
  $ci =& get_instance();
  $result =$ci->db->from('warranty')->get()->row_array();
  return $result;
}
function question(){
  $ci =& get_instance();
  $result =$ci->db->from('question')->where('status','1')->
  get()->result_array();
  return $result;
}
