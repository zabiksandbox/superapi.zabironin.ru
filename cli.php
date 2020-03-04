<?
require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/src/config/db.php';

if (PHP_SAPI == 'cli') {
    $argv = $GLOBALS['argv'];
    array_shift($argv);

    $command       = implode('/', $argv);

    switch($command){
        case 'update':{

            $db = new db();
            $db = $db->connect();
            $xmluri="http://www.cbr.ru/scripts/XML_daily.asp";
            $xml = simplexml_load_file($xmluri);

            foreach ($xml->Valute as $valute) {
                $valute->Value=str_replace(',', '.', $valute->Value);
                $intRate=$valute->Value*10000;

                $sql = "INSERT INTO currency (id, name, rate) VALUES (:id, :name, :rate ) ON DUPLICATE KEY UPDATE rate=:rate";
                try{
                    $stmt = $db->prepare($sql);
                    $stmt->bindValue(':id', (string)$valute->attributes()->ID[0] );
                    $stmt->bindValue(':name',  $valute->Name);
                    $stmt->bindValue(':rate',  $intRate);
                    $stmt->execute(); 
                } catch(PDOException $e){
                    echo '{"error": {"text": '.$e->getMessage().'}';
                }
            }

            print 'Updated'.PHP_EOL;
            break;
        }
        default :{
            print 'So empty, so dark :('.PHP_EOL;
        }
    }


}
