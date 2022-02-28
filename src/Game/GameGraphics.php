<?php

namespace Game;

abstract class GameGraphics
{
    /**
     * @param array $graphicsLines
     * @param int $delay
     * @return Npc
     */
    public static function printGraphics($graphicsLines,$delay = 0){
        if(is_array($graphicsLines)){
            echo PHP_EOL;
            foreach($graphicsLines as $graphicsLine){
                if($delay){
                    usleep($delay * 1000);
                }
                echo $graphicsLine.PHP_EOL;
            }
        }
    }

    /**
     * @param string $graphicsLine
     * @param int $delay
     * @return Npc
     */
    public static function printGraphicsSingle($graphicsLine,$delay = 0){
        if($graphicsLine != ""){
            echo PHP_EOL;
            if($delay){
                usleep($delay * 1000);
            }
            echo $graphicsLine.PHP_EOL;
        }
    }

}