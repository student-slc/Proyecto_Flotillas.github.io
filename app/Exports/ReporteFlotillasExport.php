<?php

namespace App\Exports;

use App\Models\Unidade;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\Exportable;

use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class ReporteFlotillasExport implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles
{
    /**
     * @return \Illuminate\Support\Collection
     */
    use Exportable;

    public function __construct(string $cli, string $inicio, string $final, string $unidad)
    {
        $this->cli = $cli;
        $this->inicio = $inicio;
        $this->final = $final;
        $this->unidad = $unidad;
    }
    public function collection()
    {
        $cli = $this->cli;
        $inicio = $this->inicio;
        $final = $this->final;
        $unidad = $this->unidad;
        if ($inicio == null) {
            if ($final == null) {
                if ($cli == 'todos') {
                    return Unidade::join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                        ->where('unidades.tipo', '=', 'Unidad Vehicular')
                        ->select(
                            'clientes.id',
                            'clientes.nombrecompleto',
                            'unidades.marca',
                            'unidades.serieunidad',
                            'unidades.añounidad',
                            'unidades.placas',
                            'unidades.tipounidad',
                            'unidades.razonsocialunidad',
                            'unidades.digitoplaca',
                        )->get();
                } else {
                    if ($unidad == 'todos') {
                        return Unidade::join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                            ->where('tipo', '=', 'Unidad Vehicular')
                            ->whereNot('unidades.verificacion_fecha', '=', 'Sin Fecha de Verificación')
                            ->where('unidades.cliente', '=', $cli)
                            ->select(
                                'clientes.id',
                                'clientes.nombrecompleto',
                                'unidades.marca',
                                'unidades.serieunidad',
                                'unidades.añounidad',
                                'unidades.placas',
                                'unidades.tipounidad',
                                'unidades.razonsocialunidad',
                                'unidades.digitoplaca',
                            )->get();
                    } else {
                        return Unidade::join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                            ->where('tipo', '=', 'Unidad Vehicular')
                            ->whereNot('unidades.verificacion_fecha', '=', 'Sin Fecha de Verificación')
                            ->where('unidades.cliente', '=', $cli)
                            ->where('unidades.serieunidad', '=', $unidad)
                            ->select(
                                'clientes.id',
                                'clientes.nombrecompleto',
                                'unidades.marca',
                                'unidades.serieunidad',
                                'unidades.añounidad',
                                'unidades.placas',
                                'unidades.tipounidad',
                                'unidades.razonsocialunidad',
                                'unidades.digitoplaca',
                            )->get();
                    }
                }
            } else {
                if ($cli == 'todos') {
                    return Unidade::join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                        ->where('tipo', '=', 'Unidad Vehicular')
                        ->whereNot('unidades.verificacion_fecha', '=', 'Sin Fecha de Verificación')
                        ->whereDate('unidades.verificacion_fecha', '<=', $final)
                        ->select(
                            'clientes.id',
                            'clientes.nombrecompleto',
                            'unidades.marca',
                            'unidades.serieunidad',
                            'unidades.añounidad',
                            'unidades.placas',
                            'unidades.tipounidad',
                            'unidades.razonsocialunidad',
                            'unidades.digitoplaca',
                        )->get();
                } else {
                    if ($unidad == "todos") {
                        return Unidade::join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                            ->where('tipo', '=', 'Unidad Vehicular')
                            ->whereNot('unidades.verificacion_fecha', '=', 'Sin Fecha de Verificación')
                            ->whereDate('unidades.verificacion_fecha', '<=', $final)
                            ->where('unidades.cliente', '=', $cli)
                            ->select(
                                'clientes.id',
                                'clientes.nombrecompleto',
                                'unidades.marca',
                                'unidades.serieunidad',
                                'unidades.añounidad',
                                'unidades.placas',
                                'unidades.tipounidad',
                                'unidades.razonsocialunidad',
                                'unidades.digitoplaca',
                            )->get();
                    } else {
                        return Unidade::join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                            ->where('tipo', '=', 'Unidad Vehicular')
                            ->whereNot('unidades.verificacion_fecha', '=', 'Sin Fecha de Verificación')
                            ->where('unidades.cliente', '=', $cli)
                            ->where('unidades.serieunidad', '=', $unidad)
                            ->select(
                                'clientes.id',
                                'clientes.nombrecompleto',
                                'unidades.marca',
                                'unidades.serieunidad',
                                'unidades.añounidad',
                                'unidades.placas',
                                'unidades.tipounidad',
                                'unidades.razonsocialunidad',
                                'unidades.digitoplaca',
                            )->get();
                    }
                }
            }
        } else {
            if ($final == null) {
                if ($cli == 'todos') {
                    return Unidade::join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                        ->where('tipo', '=', 'Unidad Vehicular')
                        ->whereNot('unidades.verificacion_fecha', '=', 'Sin Fecha de Verificación')
                        ->whereDate('unidades.verificacion_fecha', '>=', $inicio)
                        ->select(
                            'clientes.id',
                            'clientes.nombrecompleto',
                            'unidades.marca',
                            'unidades.serieunidad',
                            'unidades.añounidad',
                            'unidades.placas',
                            'unidades.tipounidad',
                            'unidades.razonsocialunidad',
                            'unidades.digitoplaca',
                        )->get();
                } else {
                    if ($unidad == "todos") {
                        return Unidade::join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                            ->where('tipo', '=', 'Unidad Vehicular')
                            ->whereNot('unidades.verificacion_fecha', '=', 'Sin Fecha de Verificación')
                            ->where('unidades.cliente', '=', $cli)
                            ->whereDate('unidades.verificacion_fecha', '>=', $inicio)
                            ->select(
                                'clientes.id',
                                'clientes.nombrecompleto',
                                'unidades.marca',
                                'unidades.serieunidad',
                                'unidades.añounidad',
                                'unidades.placas',
                                'unidades.tipounidad',
                                'unidades.razonsocialunidad',
                                'unidades.digitoplaca',
                            )->get();
                    } else {
                        return Unidade::join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                            ->where('tipo', '=', 'Unidad Vehicular')
                            ->whereNot('unidades.verificacion_fecha', '=', 'Sin Fecha de Verificación')
                            ->where('unidades.cliente', '=', $cli)
                            ->where('unidades.serieunidad', '=', $unidad)
                            ->select(
                                'clientes.id',
                                'clientes.nombrecompleto',
                                'unidades.marca',
                                'unidades.serieunidad',
                                'unidades.añounidad',
                                'unidades.placas',
                                'unidades.tipounidad',
                                'unidades.razonsocialunidad',
                                'unidades.digitoplaca',
                            )->get();
                    }
                }
            } else {
                if ($cli == 'todos') {
                    return Unidade::join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                        ->where('tipo', '=', 'Unidad Vehicular')
                        ->whereNot('unidades.verificacion_fecha', '=', 'Sin Fecha de Verificación')
                        ->whereDate('unidades.verificacion_fecha', '>=', $inicio)
                        ->whereDate('unidades.verificacion_fecha', '<=', $final)
                        ->select(
                            'clientes.id',
                            'clientes.nombrecompleto',
                            'unidades.marca',
                            'unidades.serieunidad',
                            'unidades.añounidad',
                            'unidades.placas',
                            'unidades.tipounidad',
                            'unidades.razonsocialunidad',
                            'unidades.digitoplaca',
                        )->get();
                } else {
                    if ($unidad == "todos") {
                        return Unidade::join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                            ->where('tipo', '=', 'Unidad Vehicular')
                            ->whereNot('unidades.verificacion_fecha', '=', 'Sin Fecha de Verificación')
                            ->whereDate('unidades.verificacion_fecha', '>=', $inicio)
                            ->whereDate('unidades.verificacion_fecha', '<=', $final)
                            ->where('unidades.cliente', '=', $cli)
                            ->select(
                                'clientes.id',
                                'clientes.nombrecompleto',
                                'unidades.marca',
                                'unidades.serieunidad',
                                'unidades.añounidad',
                                'unidades.placas',
                                'unidades.tipounidad',
                                'unidades.razonsocialunidad',
                                'unidades.digitoplaca',
                            )->get();
                    } else {
                        return Unidade::join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                            ->where('tipo', '=', 'Unidad Vehicular')
                            ->whereNot('unidades.verificacion_fecha', '=', 'Sin Fecha de Verificación')
                            ->where('unidades.cliente', '=', $cli)
                            ->where('unidades.serieunidad', '=', $unidad)
                            ->select(
                                'clientes.id',
                                'clientes.nombrecompleto',
                                'unidades.marca',
                                'unidades.serieunidad',
                                'unidades.añounidad',
                                'unidades.placas',
                                'unidades.tipounidad',
                                'unidades.razonsocialunidad',
                                'unidades.digitoplaca',
                            )->get();
                    }
                }
            }
        }
    }
    public function headings(): array
    {
        return [
            "ID CLIENTE","CLIENTE",
            "MARCA", "SERIE UNIDAD", "AÑO UNIDAD", "PLACAS", "TIPO UNIDAD", "RAZON SOCIAL UNIDAD","DIGITO PLACA",
        ];
    }
    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:I1')->applyFromArray(array(
            'fill' => array(
                'fillType' => Fill::FILL_SOLID,
                'color' => array('rgb' => '9dbad5')
            )
        ));
        return [


            // Style the first row as bold text.
            1    => ['font' => ['bold' => true]],
        ];
    }
}
