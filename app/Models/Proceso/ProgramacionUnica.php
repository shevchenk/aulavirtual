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
        
        $id=Auth::user()->id;
        $sql=DB::table('mat_matriculas AS mm')
            ->join('mat_matriculas_detalles AS mmd',function($join){
                $join->on('mmd.matricula_id','=','mm.id')
                ->where('mmd.estado',1);
            })
            ->join('personas AS p',function($join){
                $join->on('p.id','=','mm.persona_id');
            })
            ->join('mat_alumnos AS ma',function($join){
                $join->on('ma.persona_id','=','p.id');

            })
            ->join('sucursales AS s',function($join){
                $join->on('s.id','=','mm.sucursal_id');

            })
            ->join('mat_tipos_participantes AS mtp',function($join){
                $join->on('mtp.id','=','mm.tipo_participante_id');

            })
            ->join('mat_programaciones AS mp',function($join){
                $join->on('mp.id','=','mmd.programacion_id');

            })
            ->join('mat_cursos AS mc',function($join){
                $join->on('mc.id','=','mp.curso_id');

            })
            ->join('personas AS pcaj',function($join){
                $join->on('pcaj.id','=','mm.persona_caja_id');

            })
            ->join('personas AS pmar',function($join){
                $join->on('pmar.id','=','mm.persona_marketing_id');

            })
            ->join('personas AS pmat',function($join){
                $join->on('pmat.id','=','mm.persona_matricula_id');

            })
            ->select('mm.id','p.dni','p.nombre','p.paterno','p.materno','p.telefono','p.celular','p.email','ma.direccion',
                     'mm.fecha_matricula','s.sucursal','mtp.tipo_participante','mm.nro_pago_inscripcion','mm.monto_pago_inscripcion','mm.nro_pago','mm.monto_pago',
                     DB::raw('GROUP_CONCAT( IF(mp.sucursal_id=1,"OnLine","Presencial") ORDER BY mmd.id SEPARATOR "\n") modalidad'),
                     DB::raw('GROUP_CONCAT( mc.curso ORDER BY mmd.id SEPARATOR "\n") cursos'),
                     DB::raw('GROUP_CONCAT( IFNULL(mmd.nro_pago,"") ORDER BY mmd.id SEPARATOR "\n") nro_pago_c'),
                     DB::raw('GROUP_CONCAT( IFNULL(mmd.monto_pago,0) ORDER BY mmd.id SEPARATOR "\n") monto_pago_c'),
                     DB::raw('GROUP_CONCAT( mmd.nro_pago_certificado ORDER BY mmd.id SEPARATOR "\n") nro_pago_certificado'),
                     DB::raw('GROUP_CONCAT( mmd.monto_pago_certificado ORDER BY mmd.id SEPARATOR "\n") monto_pago_certificado'),
                     'mm.nro_promocion','mm.monto_promocion',
                     DB::raw('SUM(mmd.monto_pago)+SUM(mmd.monto_pago_certificado) subtotal'),
                     DB::raw('(mm.monto_pago_inscripcion+mm.monto_pago+SUM(mmd.monto_pago)+SUM(mmd.monto_pago_certificado)+SUM(mm.monto_promocion)) total'),
                     DB::raw('CONCAT_WS(" ",pcaj.paterno,pcaj.materno,pcaj.nombre) as cajera'),
                     DB::raw('CONCAT_WS(" ",pmar.paterno,pmar.materno,pmar.nombre) as marketing'),
                     DB::raw('CONCAT_WS(" ",pmat.paterno,pmat.materno,pmat.nombre) as matricula'),
                    'mm.observacion',DB::raw('COUNT(mmd.id) ndet'))
            ->where( 
                function($query) use ($r){

                    if( $r->has("fecha_inicial") AND $r->has("fecha_final")){
                        $inicial=trim($r->fecha_inicial);
                        $final=trim($r->fecha_final);
                        if( $inicial !=''AND $final!=''){
                            $query ->whereBetween(DB::raw('DATE_FORMAT(mm.fecha_matricula,"%Y-%m")'), array($r->fecha_inicial,$r->fecha_final));
                        }
                    }

                    if( $r->has("fecha_ini") AND $r->has("fecha_fin")){
                        $inicial=trim($r->fecha_ini);
                        $final=trim($r->fecha_fin);
                        if( $inicial !=''AND $final!=''){
                            $query ->whereBetween('mm.fecha_matricula', array($r->fecha_ini,$r->fecha_fin));
                        }
                    }
                }
            )
            ->where('mm.estado',1)
            ->where('mc.tipo_curso',1)
            ->whereRaw('mm.sucursal_id IN (SELECT DISTINCT(ppv.sucursal_id)
                            FROM personas_privilegios_sucursales ppv
                            WHERE ppv.persona_id='.$id.')')
            ->groupBy('mm.id','p.dni','p.nombre','p.paterno','p.materno','p.telefono','p.celular','p.email','ma.direccion',
                     'mm.fecha_matricula','s.sucursal','mtp.tipo_participante','mm.nro_pago_inscripcion','mm.monto_pago_inscripcion','mm.nro_pago','mm.monto_pago','mm.nro_promocion','mm.monto_promocion',
                     'pcaj.paterno','pcaj.materno','pcaj.nombre',
                     'pmar.paterno','pmar.materno','pmar.nombre',
                     'pmat.paterno','pmat.materno','pmat.nombre','mm.observacion');

        $result = $sql->orderBy('mm.id','asc')->get();
        return $result;
    }

    public static function runExportNota($r)
    {
//        $rsql= Reporte::runLoadPAE($r);
        $rsql=array();
        $length=array(
            'A'=>5,'B'=>15,'C'=>20,'D'=>20,'E'=>20,'F'=>15,'G'=>15,'H'=>25,'I'=>30,
            'J'=>15,'K'=>15,'L'=>15,
            'M'=>15,'N'=>15,
            'O'=>15,'P'=>15,
            'Q'=>15,'R'=>15,'S'=>15, 'T'=>15, 'U'=>15,'V'=>15,
            'W'=>20,'X'=>20,
            'Y'=>20,'Z'=>20,
            'AA'=>20,'AB'=>20,'AC'=>20,'AD'=>30
        );

        $cabecera1=array(
            'Alumnos','Matrícula','Inscripción','Matrícula',
            'Cursos','Promociones','Pagos','Responsable'
        );

        $cabecantNro=array(
            9,3,2,2,
            5,2,2,4
        );

        $cabecantLetra=array(
            'A3:I3','J3:L3','M3:N3','O3:P3',
            'Q3:V3','W3:X3','Y3:Z3','AA3:AD3'
        );

        $cabecera2=array(
            'N°','DNI','Nombre','Paterno','Materno','Telefono','Celular','Email','Dirección',
            'Fecha Matrícula','Sucursal','Tipo Participante',
            'Nro Pago Ins','Monto Pago Ins',
            'Nro Pago Mat','Monto Pago Mat',
            'Modalidad','Cursos','Nro Pago','Monto Pago','Nro Pago Certificado','Monto Pago Certificado',
            'Nro Pago Promoción','Monto Pago Promoción',
            'Sub Total Curso','Total Pagado',
            'Cajera','Marketing','Matrícula',
            'Observacion'
        );
        $campos=array(
             'id','dni','nombre','paterno','materno','telefono','celular','email','direccion',
             'fecha_matricula','sucursal','tipo_participante',
             'nro_pago_inscripcion','monto_pago_inscripcion',
             'nro_pago','monto_pago',
             'modalidad','cursos','nro_pago_c','monto_pago_c','nro_pago_certificado','monto_pago_certificado',
             'nro_promocion','monto_promocion',
             'subtotal','total',
             'cajera','marketing','matricula',
             'observacion'
        );

        $r['data']=$rsql;
        $r['cabecera1']=$cabecera1;
        $r['cabecantLetra']=$cabecantLetra;
        $r['cabecantNro']=$cabecantNro;
        $r['cabecera2']=$cabecera2;
        $r['campos']=$campos;
        $r['length']=$length;
        $r['max']='AD';
        return $r;
    }

}
