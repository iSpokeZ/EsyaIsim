<?php

/*
* _  _____             _        ______
* (_)/ ____|           | |      |___  /
*  _| (___  _ __   ___ | | _____   / /
* | |\___ \| '_ \ / _ \| |/ / _ \ / /
* | |____) | |_) | (_) |   <  __// /__
* |_|_____/| .__/ \___/|_|\_\___/_____|
*          | |
*          |_|
*
*@author iSpokeZ (Umut Yıldırım)
*
*@RainzGG Tüm Hakları Saklıdır!
*
*@Eklenti Umut Yıldırım Tarafından Özel Olarak Kodlanmıştır. Dağıtılması Kesinlikle Yasaktır!
*
*@YouTube - iSpokeZ
*
*/

namespace iSpokeZ;

use pocketmine\plugin\Plugin;
use pocketmine\plugin\PluginBase;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\Player;
use pocketmine\utils\TextFormat as C;
use pocketmine\Server;
use pocketmine\item\Item;

class Name extends PluginBase {

    public function onEnable(){
        $this->getLogger()->info("§7> §aAktif");
    }

    public function onDisable(){
        $this->getLogger()->info("§7> §cDe-Aktif");
    }

    public function onCommand(CommandSender $sender, Command $kmt, string $label, array $args): bool{
        switch ($kmt->getName()) {
            case "eisim":
                $this->isimForm($sender);
        }
        return true;
    }

    public function isimForm(Player $o){
        $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
        $form = $api->createCustomForm(function(Player $o, array $args){
            $re = $args[0];
            if($re === null){
                return true;
            }
            switch($re){
                case 0:
                    $esya = $o->getInventory()->getItemInHand();
                    $esya->clearCustomName();
                    $esya->setCustomName(str_replace("&", C::ESCAPE, "§e" . $args[0]));
                    $o->getInventory()->setItemInHand($esya);
                    $o->sendMessage("§7» §aIsim Değiştirme Başarılı");
                    break;
                }
            });
        $form->setTitle("§3Eşya Ismi Değiştirme Menüsü");
        $form->addInput("§eEşyanın Ismini Ne Yapmak Istiyorsan Aşağıya Yaz\n\n§7Eşya Ismi");
        $form->addLabel("");
        $form->sendToPlayer($o);
    }
}
