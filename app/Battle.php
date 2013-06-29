<?php
/**
 *  Battle.php
 *
 *  @author     {$author}
 *  @package    Tomoe
 *  @version    $Id$
 */


class Battle
{

    /**      
     *  コンストラクタ
     *
     *  @access public
     */
    public function __construct()
    {
    }

    /**      
     *  敵に攻撃
     *
     *  @access public
     *  @return enemy 
     */
    public function attack($result)
    {
        $status = $result['user'];
        $enemy = $result['enemy'];

        $damage = (int)(($status['attack'] - $enemy['defence']) * (100 + $status['SJ'] / 100) * mt_rand(5, 15) / 1000);
        if ($damage <= 0)
            $damage = 1;
        $enemy['HP'] = $enemy['HP'] - $damage;
        if ($enemy['HP'] <= 0)
            $enemy['HP'] = 0;
        
        $result['enemy']['HP'] = $enemy['HP'];
        $result['attack'] += $damage;
        return $result;
    }
    
    /**      
     *  敵からダメージ
     *
     *  @access public
     *  @return status 
     */
    public function damage($result)
    {
        $status = $result['user'];
        $enemy = $result['enemy'];

        $damage = (int)(($enemy['attack'] - $status['defence']) * (100 - $status['SJ']) * mt_rand(5, 15) / 1000);
        if ($damage <= 0)
            $damage = 1;
        $status['HP'] = $status['HP'] - $damage;
        if ($status['HP'] <= 0)
            $status['HP'] = 0;

        $result['user']['HP'] = $status['HP'];
        $result['damage'] += $damage;
        return $result;
    }
    
    /**
     *  雑魚戦の戦闘の結果を得る 
     */
    public function getResultNormal($result)
    {
        while ($result['user']['HP'] != 0) {
            $result = $this->attack($result);
            error_log($result['enemy']['name'] . ":" . $result['enemy']['HP']);
            if ($result['enemy']['HP'] == 0) {
                $result['win'] = 1;  // 勝ち
                break;
            }
            $result = $this->damage($result);
            error_log("userHP:" . $result['user']['HP']);
        }
        return $result;
    }

    /**
     *  ボス戦の戦闘の結果を得る 
     */
    public function getResultBoss($result)
    {
        while ($result['user']['HP'] != 0) {
            $result = $this->attack($result);
            if ($result['enemy']['HP'] == 0) {
                $result['win'] = 1;  // 勝ち
                break;
            }
            $result = $this->damage($result);
        }
        return $result;
    }

    /**
     *  戦闘の結果を得る 
     */
    public function getResult($status, $enemy, $isBoss)
    {
        $result = array();
        $result['user'] = $status;
        $result['enemy'] = $enemy;
        $result['win'] = 0;
        $result['attack'] = 0;
        $result['damage'] = 0;
        
        if ($isBoss == 0) {
            // 雑魚
            $result = $this->getResultNormal($result);
        } else {
            // ボス
            $result = $this->getResultBoss($result);
        }

        // 勝敗で分岐
        if ($result['win'] == 1) {
            // 勝ち。獲得報酬
            $result['exp'] = $result['enemy']['exp'];
            $result['money'] = $result['enemy']['level'] * mt_rand(50, 100);
            $result['SJ'] = $result['enemy']['level'] * 5;

            $result['user']['exp'] += $result['exp'];
            $result['user'] = $this->checkRaiseLV($result['user']);
            $result['user']['SJ'] += $result['SJ'];
            $result['user']['money'] += $result['money'];
        } else {
            // 負け。SJが濁る
            $result['SJ'] = $result['enemy']['level'] * 5;
            $result['user']['SJ'] -= $result['SJ'];
            if ($result['user']['SJ'] < 0) {
                // game over
                $result['gameover'] = 1;
            }
        }
        return $result;   
    }

    /**
     *  レベル上昇チェック。 
     *  ステータスのnextexp, level, attack, defenceが更新される
     */
    public function checkRaiseLV($status)
    {
        $raise_count = 0;
        while ($status['nextexp'] <= $status['exp']) {
            $status['level'] += 1;
            $status['attack'] += mt_rand(1, 3);
            $status['defence'] += mt_rand(1, 3);
            $norma = $status['level'] * 10;
            $status['nextexp'] += $norma;
            $raise_count++;
        }
        return $status;
    }
            
}

