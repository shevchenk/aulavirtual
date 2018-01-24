<?php
namespace App\Models\Proceso;

use Illuminate\Database\Eloquent\Model;
use DB;

class ProgramacionUnica extends Model
{
    protected   $table = 'v_programaciones_unicas';

    public static function runLoad($r)
    {
        $result=ProgramacionUnica::select('v_programaciones_unicas.id',
                                DB::raw('DATE(v_programaciones_unicas.fecha_inicio) as fecha_inicio'),
                                DB::raw('DATE(v_programaciones_unicas.fecha_final) as fecha_final'),
                                'vc.curso','vc.foto','vc.foto_cab','v_programaciones_unicas.curso_id',
                                'v_programaciones_unicas.ciclo','v_programaciones_unicas.carrera','v_programaciones_unicas.semestre',
                                DB::raw('CONCAT_WS(" ",vp.paterno,vp.materno,vp.nombre) as docente'),'vp.dni')
                                ->join('v_cursos as vc','vc.id','=','v_programaciones_unicas.curso_id')
                                ->join('v_personas as vp','vp.id','=','v_programaciones_unicas.persona_id')
                                ->where(
                                    function($query) use ($r){
                                       $query->where('v_programaciones_unicas.estado','=',1);
                                       
                                       if( $r->has("dni") ){
                                              $dni=trim($r->dni);
                                              if( $dni !='' ){
                                                  $query->where('vp.dni','=', $dni);
                                              }
                                        }
                                        if( $r->has("curso") ){
                                            $curso=trim($r->curso);
                                            if( $curso !='' ){
                                                $query->where('vc.curso','like','%'.$curso.'%');
                                            }
                                        }
                                        if( $r->has("carrera") ){
                                            $carrera=trim($r->carrera);
                                            if( $carrera !='' ){
                                                $query->where('v_programaciones_unicas.carrera','like','%'.$carrera.'%');
                                            }
                                        }
                                        if( $r->has("ciclo") ){
                                            $ciclo=trim($r->ciclo);
                                            if( $ciclo !='' ){
                                                $query->where('v_programaciones_unicas.ciclo','like','%'.$ciclo.'%');
                                            }
                                        }
                                        if( $r->has("semestre") ){
                                            $semestre=trim($r->semestre);
                                            if( $semestre !='' ){
                                                $query->where('v_programaciones_unicas.semestre','like','%'.$semestre.'%');
                                            }
                                        }
                                        if( $r->has("fecha_inicio") ){
                                            $fecha_inicio=trim($r->fecha_inicio);
                                            if( $fecha_inicio !='' ){
                                                $query->where('v_programaciones_unicas.fecha_inicio','like','%'.$fecha_inicio.'%');
                                            }
                                        }

                                        if( $r->has("fecha_final") ){
                                            $fecha_final=trim($r->fecha_final);
                                            if( $fecha_final !='' ){
                                                $query->where('v_programaciones_unicas.fecha_final','like','%'.$fecha_final.'%');
                                            }
                                        }
                                    }
                                )
                                ->orderBy('v_programaciones_unicas.id','asc')->paginate(10);

        return $result;
    }
    
    public static function runLoadNota($r){

        $abc=array('C','D','E','F','G','H','I','J','K','L','M','N');
        $aux_unidad_contenido_id=0;
        $aux_key_fin=0;
        $aux_cantNro=0;
        
        $length=array('A'=>5,'B'=>15);
        $cabecera1=array('Alumnos');
        $cabecera2=array('N°','Alumno');
        $max='B';
        $cabecantLetra=array('A2:B2');
        $campos=array('alumno');
        $cabecantNro=array(2);
        
        $left_unidad_contenido=DB::table('v_unidades_contenido as vuco')
                                ->select('vuco.id','vuco.unidad_contenido','vco.id as contenido_id')
                                ->join('v_contenidos as vco', function($join)use($r){
                                    $join->on('vco.unidad_contenido_id','=','vuco.id')
                                         ->where('vco.tipo_respuesta','=',1)
                                         ->where('vco.programacion_unica_id','=',$r->programacion_unica_id)
                                         ->where('vco.estado','=',1);
                                })
                                ->where('vuco.id','!=',1)
                                ->orderBy('vuco.id')->get();

        $sql= ProgramacionUnica::select(DB::raw("CONCAT_WS(' ',vpe.paterno,vpe.materno,vpe.nombre) as alumno"))
                ->join('v_programaciones as vpro', function($join){
                  $join->on('vpro.programacion_unica_id','=','v_programaciones_unicas.id')
                     ->where('vpro.estado','=',1);
                })
                ->join('v_personas as vpe', function($join){
                    $join->on('vpe.id','=','vpro.persona_id');
                });
        $array_groupby=array('vpe.id','vpe.paterno','vpe.materno','vpe.nombre');
        if(count($left_unidad_contenido)>0){
            foreach($left_unidad_contenido as $key => $res){
                $sql->addSelect(DB::raw("IFNULL(vcore$key.nota,0) as t$key"))
                    ->leftjoin('v_contenidos_respuestas as vcore'.$key, function($join)use($res,$key){
                        $join->where('vcore'.$key.'.contenido_id','=',$res->contenido_id)
                             ->where('vcore'.$key.'.estado','=',1)
                             ->on('vcore'.$key.'.persona_id_created_at','=','vpe.id');
                    });
                array_push($array_groupby,"vcore$key.nota");
                array_push($cabecera2,"Tarea");
                array_push($campos,"t$key");
                $length[$abc[$key]]=20;
                $max=$abc[$key+1];

                if($aux_unidad_contenido_id!==$res->id){
                    $aux_unidad_contenido_id = $res->id;
                    array_push($cabecera1,$res->unidad_contenido);
                    $aux_key_fin=$key;
                    array_push($cabecantLetra,$abc[$key].'3:'.$abc[$aux_key_fin].'3');
                    if ($key > 0) {
                       array_push($cabecantNro,$aux_cantNro);
                    }
                    $aux_cantNro=1;
                }else{
                    $aux_key_fin=$key;
                    $aux_cantNro++;
                }
            }
            $sql->addSelect(DB::raw("SUM(IFNULL(vcoret.nota,0))/COUNT(IFNULL(vcoret.nota,0)) as promedio"))
                ->leftjoin('v_contenidos as vco', function($join){
                        $join->where('vco.tipo_respuesta','=',1)
                             ->where('vco.estado','=',1)
                             ->on('vco.programacion_unica_id','=','v_programaciones_unicas.id');
                    })
                ->leftjoin('v_contenidos_respuestas as vcoret', function($join){
                        $join->on('vcoret.persona_id_created_at','=','vpe.id')
                             ->where('vcoret.estado','=',1)
                             ->on('vcoret.contenido_id','=','vco.id');
                    });

            array_push($cabecantNro,$aux_cantNro);
            array_push($cabecera2,"Promedio");
            array_push($campos,"promedio");
            array_push($cabecantNro,1);
        }
        
        $result =$sql->where('v_programaciones_unicas.id','=',$r->programacion_unica_id)
                     ->groupBy($array_groupby)->get();
        
        $rst['data']=$result;
        $rst['length']=$length;
        $rst['cabecera1']=$cabecera1;
        $rst['max']=$max;
        $rst['cabecera2']=$cabecera2;
        $rst['cabecantLetra']=$cabecantLetra;
        $rst['campos']=$campos;
        $rst['cabecantNro']=$cabecantNro;
        return $rst;
    }

    public static function runExportNota($r)
    {
        $rsql= ProgramacionUnica::runLoadNota($r);
//        dd($rsql['data']);
        $length=array(
            'A'=>5,'B'=>15,'C'=>20,'D'=>20,'E'=>20,'F'=>15
        );

        $cabecera1=array(
            'Alumnos','Unidad I','Unidad II','Unidad II','Unidad IV'
        );

        $cabecantNro=array(
            2,1,1,1,
            1
        );

        $cabecantLetra=array(
            'A3:B3'
        );

        $cabecera2=array(
            'N°','Alumno','Tarea 1','Tarea 1','Tarea 1','Tarea 1'
        );
        $campos=array(
             'id','alumno','nota0','nota1','nota2','nota3'
        );

        $r['data']=$rsql['data'];
        $r['cabecera1']=$rsql['cabecera1'];
        $r['cabecantLetra']=$rsql['cabecantLetra'];
        $r['cabecantNro']=$rsql['cabecantNro'];
        $r['cabecera2']=$rsql['cabecera2'];
        $r['campos']=$rsql['campos'];
        $r['length']=$rsql['length'];
        $r['max']=$rsql['max'];
        return $r;
    }

}
