<?php
namespace App\Models\Proceso;

use Illuminate\Database\Eloquent\Model;
use DB;
use Illuminate\Support\Facades\Auth;

class ProgramacionUnica extends Model
{
    protected   $table = 'v_programaciones_unicas';

    public static function runLoad($r)
    {
        $result=ProgramacionUnica::select('v_programaciones_unicas.id','v_programaciones_unicas.plantilla',
                                DB::raw('DATE(v_programaciones_unicas.fecha_inicio) as fecha_inicio'),
                                DB::raw('DATE(v_programaciones_unicas.fecha_final) as fecha_final'),
                                'vc.curso','vc.foto','vc.foto_cab','v_programaciones_unicas.curso_id',
                                'v_programaciones_unicas.ciclo','v_programaciones_unicas.carrera','v_programaciones_unicas.semestre',
                                DB::raw('CONCAT_WS(" ",vp.paterno,vp.materno,vp.nombre) as docente'),'vp.dni',DB::raw('COUNT(vco.id) as cant_contenido'))
                                ->join('v_cursos as vc','vc.id','=','v_programaciones_unicas.curso_id')
                                ->join('v_personas as vp','vp.id','=','v_programaciones_unicas.persona_id')
                                ->leftjoin('v_contenidos as vco', function($join)use($r){
                                    $join->on('vco.programacion_unica_id','=','v_programaciones_unicas.id')
                                         ->where('vco.estado','=',1);
                                })
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
                                ->groupBy('v_programaciones_unicas.id','v_programaciones_unicas.plantilla','v_programaciones_unicas.fecha_inicio',
                                'v_programaciones_unicas.fecha_final','vc.curso','vc.foto','vc.foto_cab','v_programaciones_unicas.curso_id',
                                'v_programaciones_unicas.ciclo','v_programaciones_unicas.carrera','v_programaciones_unicas.semestre',
                                'vp.paterno','vp.materno','vp.nombre','vp.dni')
                                ->orderBy('v_programaciones_unicas.id','asc')->paginate(10);

        return $result;
    }
    
    public static function runLoadNota($r){

        $abc=array('C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
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
    
    public static function runLoadAuditoriaE($r){

        $sql= ProgramacionUnica::select(DB::raw("CONCAT_WS(' ',vpe.paterno,vpe.materno,vpe.nombre) as alumno"),
                "vev.fecha_reprogramada_inicial","vev.fecha_reprogramada_final",
                DB::raw("CONCAT_WS(' ',vpea.paterno,vpea.materno,vpea.nombre) as registra"))
                ->join('v_programaciones as vpro', function($join){
                  $join->on('vpro.programacion_unica_id','=','v_programaciones_unicas.id')
                     ->where('vpro.estado','=',1);
                })
                ->join('v_personas as vpe', function($join){
                    $join->on('vpe.id','=','vpro.persona_id');
                })
                ->leftjoin('v_evaluaciones as vev', function($join){
                    $join->on('vev.programacion_id','=','vpro.id')
                         ->where('vev.estado_cambio','=',3)
                         ->where('vev.estado','=',1);
                })
                ->join('v_personas as vpea', function($join){
                    $join->on('vpea.id','=','vev.persona_id_updated_at');
                });
        
        $result =$sql->where('v_programaciones_unicas.id','=',$r->programacion_unica_id)->get();
        
        return $result;
    }

    public static function runExportAuditoriaE($r){
        $rsql= ProgramacionUnica::runLoadAuditoriaE($r);

        $length=array(
            'A'=>5,'B'=>15,'C'=>20,'D'=>20,'E'=>20
        );

        $cabecera1=array(
            '','','',''
        );

        $cabecantNro=array(
            2,1,1,1,
            1
        );

        $cabecantLetra=array(
            'A3:B3'
        );

        $cabecera2=array(
            'N°','Alumno','Fecha Inicial','Fecha  Final','Registra'
        );
        $campos=array(
             'alumno','fecha_reprogramada_inicial','fecha_reprogramada_final','registra'
        );

        $r['data']=$rsql;
        $r['cabecera1']=$cabecera1;
        $r['cabecantLetra']=$cabecantLetra;
        $r['cabecantNro']=$cabecantNro;
        $r['cabecera2']=$cabecera2;
        $r['campos']=$campos;
        $r['length']=$length;
        $r['max']='E';
        return $r;
    }
    
    public static function runLoadAuditoriaC($r){

        $sqlM= ProgramacionUnica::select(DB::raw("CONCAT_WS(' ',vpe.paterno,vpe.materno,vpe.nombre) as alumno"),
                "vco.fecha_ampliada",DB::raw("CONCAT_WS(' ',vpea.paterno,vpea.materno,vpea.nombre) as registra"))
                ->join('v_programaciones as vpro', function($join){
                  $join->on('vpro.programacion_unica_id','=','v_programaciones_unicas.id')
                     ->where('vpro.estado','=',1);
                })
                ->join('v_personas as vpe', function($join){
                    $join->on('vpe.id','=','vpro.persona_id');
                })
                ->join('v_contenidos as vco', function($join){
                    $join->on('vco.programacion_unica_id','=','v_programaciones_unicas.id')
                         ->where('vco.estado',1)
                         ->whereNotNull('vco.persona_masivo');
                })
                ->join('v_personas as vpea', function($join){
                    $join->on('vpea.id','=','vco.persona_masivo');
                });
        
        $resultM =$sqlM->where('v_programaciones_unicas.id','=',$r->programacion_unica_id)->get();
        
        $sqlI= ProgramacionUnica::select(DB::raw("CONCAT_WS(' ',vpe.paterno,vpe.materno,vpe.nombre) as alumno"),
                "vev.fecha_ampliacion  as fecha_ampliada",DB::raw("CONCAT_WS(' ',vpea.paterno,vpea.materno,vpea.nombre) as registra"))
                ->join('v_programaciones as vpro', function($join){
                  $join->on('vpro.programacion_unica_id','=','v_programaciones_unicas.id')
                     ->where('vpro.estado','=',1);
                })
                ->join('v_personas as vpe', function($join){
                    $join->on('vpe.id','=','vpro.persona_id');
                })
                ->leftjoin('v_contenidos_programaciones as vev', function($join){
                    $join->on('vev.programacion_id','=','vpro.id')
                         ->where('vev.estado','=',1);
                })
                ->join('v_personas as vpea', function($join){
                    $join->on('vpea.id','=','vev.persona_id_created_at');
                });
        
        $resultI =$sqlI->where('v_programaciones_unicas.id','=',$r->programacion_unica_id)->get();
        
        $result['resultM']=$resultM;
        $result['resultI']=$resultI;
        return $result;
    }

    public static function runExportAuditoriaC($r){
        $rsql= ProgramacionUnica::runLoadAuditoriaC($r);
        
        $cabecera1=array(
            '','','',''
        );

        $cabecantNro=array(
            1,1,1,1
        );

        $cabecera2=array(
            'N°','Alumno','fecha_ampliada','Registra'
        );
        $campos=array(
             'alumno','fecha_ampliada','registra'
        );

        $r['dataI']=$rsql['resultI'];
        $r['dataM']=$rsql['resultM'];
        $r['cabecera1']=$cabecera1;
        $r['cabecantNro']=$cabecantNro;
        $r['cabecera2']=$cabecera2;
        $r['campos']=$campos;
        $r['max']='D';
        return $r;
    }
    
    public static function runEditTemplate($r){
        
        $pro_unica = ProgramacionUnica::find($r->id);
        $pro_unica->plantilla = trim( $r->estadot );
        $pro_unica->persona_id_updated_at=1;
        $pro_unica->save();
        
        $actualizar= ProgramacionUnica::where('curso_id','=',$pro_unica->curso_id)
                                       ->where('id','!=',$pro_unica->id)->get();
        
        foreach($actualizar as $value){
            $pro_unica = ProgramacionUnica::find($value->id);
            $pro_unica->plantilla=0;
            $pro_unica->save();  
        }
    }
    
    public static function runReplicarTemplate($r){

        $programacion_unica= ProgramacionUnica::where("curso_id","=",$r->curso_id)
                                              ->where("plantilla","=",1)->first();
        
        if($programacion_unica){
            $data=Contenido::where("programacion_unica_id","=",$programacion_unica->id)->get();

            foreach ($data as $result){
                $contenido = new Contenido;
                $contenido->programacion_unica_id =$r->programacion_unica_id;
                $contenido->curso_id =$result->curso_id;
                $contenido->contenido =$result->contenido;
                $contenido->tipo_respuesta =$result->tipo_respuesta;
                $contenido->titulo_contenido =$result->titulo_contenido;
                $contenido->unidad_contenido_id =$result->unidad_contenido_id;

                if($result->fecha_inicio!=''){
                    $contenido->fecha_inicio =$result->fecha_inicio ;
                }
                if($result->fecha_final!=''){
                    $contenido->fecha_final =$result->fecha_final;
                }
                if($result->fecha_ampliada!=''){
                    $contenido->fecha_ampliada =$result->fecha_ampliada;
                }
                $contenido->referencia=  $result->referencia;
                $contenido->estado =$result->estado;
                $contenido->persona_id_created_at=Auth::user()->id;
                $contenido->save();

                if ( !is_dir('file/content/c'.$contenido->id) ) {
                     mkdir('file/content/c'.$contenido->id,0777);
                }
                $file_archivo=explode('/', $result->ruta_contenido);
                $file_fichero = 'file/content/'.$result->ruta_contenido;
                $file_nuevo_fichero = 'file/content/c'.$contenido->id.'/'.$file_archivo[1];

                copy($file_fichero,$file_nuevo_fichero);
                $contenido->ruta_contenido='c'.$contenido->id.'/'.$file_archivo[1];

                if($result->foto!='default/nodisponible.png'){
                    $archivo=explode('/', $result->foto);
                    $fichero = 'file/content/'.$result->foto;
                    $nuevo_fichero = 'file/content/c'.$contenido->id.'/'.$archivo[1];

                    copy($fichero,$nuevo_fichero);
                    $contenido->foto='c'.$contenido->id.'/'.$archivo[1]; 
                }else{
                    $contenido->foto=$result->foto; 
                }

                $contenido->save();
            }
            
            $r['rst']=1;
            $r['msj']="Registro actualizado";
            return $r;
            
        }else{
            
            $r['rst']=2;
            $r['msj']="No hay un template designado";
            return $r;
        }       
    }

}
