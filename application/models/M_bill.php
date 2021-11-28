<?php

class M_bill extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    function getRoom($id_k = 0)
    {
        $this->db->select('*, tbl_jenis_kamar.bed');
        $this->db->from('tbl_jenis_kamar, tbl_kamar');
        $this->db->where('tbl_jenis_kamar.id_jkamar = tbl_kamar.id_jkamar');
        $this->db->where('id_kamar', $id_k);
        return $this->db->get()->row();
    }
    function cekBillPrice($id = 0)
    {
        $this->db->select('idtbl_bill_price');
        $this->db->where('id_bill', $id);
        return $this->db->get('tbl_bill_price')->num_rows();
    }
    function saveBillPrice($d)
    {
        $this->db->insert('tbl_bill_price', $d);
    }
    function UpBillPrice($d)
    {
        $this->db->where('id_bill', $d['id_bill']);
        $this->db->update('tbl_bill_price', $d);
    }
    function getPrice($id = 0, $h)
    {
        $cek = $this->cekBillPrice($id);
        if ($cek == 0) {
            $d = [
                'id_bill' => $id,
                'price' => $h,
                'type' => 0,
            ];
            $this->saveBillPrice($d);
        }

        $this->db->select('price, type');
        $this->db->where('id_bill', $id);
        return $this->db->get('tbl_bill_price')->row();
    }
    function getPriceRoom($id, $id_k)
    {
        $hr = $this->getRoom($id_k);
        $p = $this->getPrice($id, $hr->harga_n);
        $out = [
            "harga" => $p->price,
            "type" => $p->type,
            "normal" => $hr->harga_n,
            "sesion" => $hr->harga_p,
            "weekdays" => $hr->harga_days,
            "weekend" => $hr->harga_end,
            "longweekend" => $hr->harga_long,
            "bed" => $hr->bed,
            "ot" => $hr->ot,
            "ot2" => $hr->ot2,
            "nilai" => $hr->nilai,
            "room_type" => $hr->jenis_kamar,
        ];
        $object = json_decode(json_encode($out), FALSE);
        return $object;
    }

    function searchNota_Room($tipe, $dep = "no", $rf = 'tdk', $nota)
    { ////tipe ///rekap berdasarkan tipe
        $this->db->from('tbl_pesan_kamar');
        $this->db->where('boking', $dep); //no ,ya
        $this->db->where('refund', $rf); //tdk , pas
        $this->db->order_by('nota', 'ASC');
        $this->db->where('tipe', $tipe); //K, N
        $this->db->where('nota', $nota); //K, N
        return $this->db->get();
    }
}
