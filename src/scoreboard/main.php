<?PHP
namespace scoreboard;
//必須
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
//パケット
use pocketmine\network\mcpe\protocol\SetDisplayObjectivePacket;
use pocketmine\network\mcpe\protocol\SetScorePacket;
use pocketmine\network\mcpe\protocol\RemoveObjectivePacket;
use pocketmine\network\mcpe\protocol\types\ScorePacketEntry;
//イベント
use pocketmine\event\player\PlayerRespawnEvent;

class main extends PluginBase implements Listener{

    public function onEnable(){
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->getServer()->getLogger()->info("ScoreBoard was enabled.");  
    }

    public function Respawn(PlayerRespawnEvent $event){
        $player = $event->getPlayer();
        $pk = new SetScorePacket;
        $pk->type = 0;
        $pk->entries = [new ScorePacketEntry()];
        $pk->entries[0]->uuid = $player->getUniqueId();
        $pk->entries[0]->objectiveName = "test";
        $pk->entries[0]->score = 200;
        $player->dataPacket($pk);
        $pk1 = new SetDisplayObjectivePacket;
        $pk1->displaySlot = "sidebar";
        $pk1->objectiveName = "test";
        $pk1->displayName = "test";
        $pk1->criteriaName = "dummy";
        $pk1->sortOrder = 0;
        $player->dataPacket($pk1);
        return true;
    }


}