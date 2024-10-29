<?php
class globals{
    public function setMsg($name,$value,$css){
        if(is_array($value)){
            $_SESSION[$name]=$value;
        }else{
            $_SESSION[$name]="<div class='".$css."'>".$value."</div>";
        }
    }
    public function getMsg($name){
        if(isset($_SESSION[$name])){
            $session=$_SESSION[$name];
            unset($_SESSION[$name]);
            return $session;
        }
    }


    public function generateUsername() {

        $randomWords = [
            'star', 'lion', 'king', 'hero', 'nova', 'tiger', 'eagle', 'phoenix', 'falcon', 'storm', 
            'shadow', 'wolf', 'raven', 'dragon', 'comet', 'viper', 'blaze', 'panther', 'wizard', 'sparrow',
            'frost', 'cyclone', 'cobra', 'griffin', 'spark', 'thunder', 'quake', 'hawk', 'tornado', 'serpent',
            'fire', 'blizzard', 'night', 'jaguar', 'meteor', 'zephyr', 'crystal', 'bolt', 'whirlwind', 'nebula',
            'flash', 'phantom', 'venom', 'ranger', 'hawk', 'reaper', 'beast', 'flare', 'warrior', 'razor',
            'gale', 'inferno', 'wildcat', 'iron', 'hydra', 'onyx', 'sabre', 'silver', 'boulder', 'stormy',
            'breeze', 'ember', 'glacier', 'onyx', 'quake', 'fury', 'rogue', 'tempest', 'mystic', 'fierce',
            'thunderbolt', 'claw', 'fable', 'obsidian', 'howler', 'vortex', 'brave', 'blade', 'vengeance', 'tiger',
            'zephyr', 'warden', 'mirage', 'sphinx', 'stellar', 'nova', 'striker', 'maverick', 'rogue', 'brimstone',
            'ranger', 'quicksilver', 'burn', 'saber', 'raider', 'lightning', 'chaos', 'revenant', 'wildfire', 'bison',
            'titan', 'rebel', 'scorpion', 'raptor', 'steel', 'goliath', 'blackout', 'moondust', 'crimson', 'cerberus',
            'leviathan', 'brisk', 'wild', 'drake', 'arcane', 'omen', 'drifter', 'puma', 'thorn', 'wraith',
            'dash', 'stellar', 'legend', 'prowler', 'sparks', 'rune', 'scout', 'flare', 'dusk', 'ironclad',
            'ember', 'echo', 'shadow', 'blitz', 'raven', 'typhoon', 'phoenix', 'vigilant', 'jungle', 'cypher',
            'pyro', 'maestro', 'rhino', 'onyx', 'strider', 'fang', 'eclipse', 'gargoyle', 'zenith', 'warden',
            'hydra', 'oracle', 'blaze', 'oracle', 'radiant', 'smoke', 'howl', 'mongoose', 'stratos', 'apex',
            'wyvern', 'foxtrot', 'hellfire', 'cyber', 'riptide', 'flare', 'wildcard', 'twilight', 'forge', 'cobalt',
            'thunderstrike', 'zenith', 'warden', 'spectre', 'quasar', 'avalanche', 'mystique', 'juggernaut', 'saber', 'valiant',
            'nebula', 'tremor', 'griffon', 'valkyrie', 'shade', 'guardian', 'patriot', 'bronco', 'flash', 'cyclops',
            'magnet', 'echo', 'dynamo', 'crusader', 'viper', 'hunter', 'mystic', 'warp', 'shockwave', 'legend',
            'cypher', 'shadow', 'pulse', 'nightmare', 'shifter', 'ghost', 'hybrid', 'swarm', 'wind', 'skyfall'
        ];
        
        
        $word = $randomWords[array_rand($randomWords)];
    
        $randomNumber = rand(100, 999);

        $username = strtolower($word) .'_'. $randomNumber;
    
        return $username;
    }

    

}