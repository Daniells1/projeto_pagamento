<?php 

namespace App\Helpers;

class Helper{
                    public static function fn($value, $decimals = 2, $decimalSeparator = "," , $thounsands = "."){
                        if($value == "" || $value == null || !is_numeric($value)) return "R$ 0,00";

                        return "R$ " . \number_format($value, $decimals, $decimalSeparator, $thounsands);

                    }
                    public static function formatDate($data, $formatDateIn = "Y-m-d", $formatDateOut = "d/m/Y"){
                        if($date == "" || $date == null) return null;
                    try{
                        $dt = \Carbon\Carbon::createFromFormat($formatDateIn, $date);
                        return $dt->format($formatDateOut);
                    }catch(\Exception $e){
                        \Log::error("Erro Helper formatDate", [ $e->getMessage()]);
                        return "";
                    }
            
                }
            }
