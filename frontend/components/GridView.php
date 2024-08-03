<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

namespace frontend\components;

use yii\helpers\Html;
use yii\grid\Column;

/**
 * Description of GridView
 *
 * @author AlexN_2
 */
class GridView extends \yii\grid\GridView {
    
    /**
     * Renders the table header.
     * @return string the rendering result.
     */
    public function renderTableHeader()
    {
        $tr_count = 3;
        $cells = [];
        foreach (range(0, $tr_count-1) as $key) {
            foreach ($this->columns as $kc => $column) {
                /* @var $column Column */
                if($key === 0 & in_array($kc, [0,1,2, count($this->columns)-1])) {
                    $cells[$key][] = $column->renderHeaderCell();
                } elseif ($key === 1 & in_array($kc, [0,1,2, count($this->columns)-1])) {
                    continue;
                } else {
                    $cells[$key][] = $column->renderHeaderCell();
                }
                
            }            
        }
        //error_log(print_r($cells, true));
        $content = Html::tag('tr', $cells[0][0].$cells[0][1].$cells[0][2].'<th colspan="9">'. $this->options['data-date'].'</th>'.$cells[0][count($this->columns)-1], $this->headerRowOptions);
        $content .= Html::tag('tr', '<th colspan="7">Реализовано</th><th colspan="2">Оплачено</th>', $this->headerRowOptions);
        $content .= Html::tag('tr', implode('', $cells[1]), $this->headerRowOptions);
        if ($this->filterPosition === self::FILTER_POS_HEADER) {
            $content = $this->renderFilters() . $content;
        } elseif ($this->filterPosition === self::FILTER_POS_BODY) {
            $content .= $this->renderFilters();
        }

        return "<thead>\n" . $content . "\n</thead>";
    }    

    /**
     * Renders the table footer.
     * @return string the rendering result.
     */
    public function renderTableFooter()
    {
        $tr_count = 3;
        $cells = [];        
        foreach (range(0, $tr_count-1) as $key) {
            foreach ($this->columns as $kc => $column) {
                /* @var $column Column */
                if (isset ($column->footerOptions['data-footer'][$key-1])) {
                    if($column->footerOptions['data-footer'][$key-1] === false) {
                        continue;
                    }
                    $cells[$key][] = Html::tag('td', $column->footerOptions['data-footer'][$key-1] !== null && trim($column->footerOptions['data-footer'][$key-1]) !== '' ? $column->footerOptions['data-footer'][$key-1] : $column->grid->emptyCell, isset($column->footerOptions['data-options'][$key-1]) ? $column->footerOptions['data-options'][$key-1] : []);
                } else {
                    if($column->footer === false) {
                        continue;
                    }
                    $cells[$key][] = $column->renderFooterCell();
                }
                
                
            }            
        }
        $content = '';
        foreach (range(0, $tr_count-1) as $key) {
            $content .= Html::tag('tr', implode('', $cells[$key]), $this->footerRowOptions);           
        }
    
        if ($this->filterPosition === self::FILTER_POS_FOOTER) {
            $content .= $this->renderFilters();
        }

        return "<tfoot>\n" . $content . "\n</tfoot>";
    }    
}
