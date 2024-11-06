<div class="container panel ">
  <div class="table-responsive panel-body">

    <table class="table"><br />
      <h4 class="well">Pengaturan Harga Kamar</h4>
      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myfblplus">
        <span class="glyphicon glyphicon-plus"></span> Tambah Jenis kamar
      </button>
      <br />
      <br />
      <table class="table table-striped table-hover">
        <tr>
          <th>No.</th>
          <th>Jenis Kamar</th>
          <th>Harga Normal</th>
          <th>Harga Peake Season</th>
          <th>Harga weekdays</th>
          <th>Harga weekend</th>
          <th>Harga longweekend</th>
          <th>BED</th>
          <th>OVERTIME <small>max 3 jam</small></th>
          <th>OVERTIME <small>4 - 6 jam</small></th>
          <th>Menu</th>
        </tr>
        <?php
        $get = $this->Madmin->geg_all_jenis_kamar();

        $no = 1;
        foreach ($get->result() as $q) {
          $get_k = $q->harga_p;
          $bed = $q->bed;
          $ot = $q->ot;
          $ot1 = $q->ot2;
          if ($this->Madmin->get_sempeljenis($q->id_jkamar)->num_rows() == 0) {
          }

        ?>
          <tr>
            <td><?= $no++ ?></td>
            <td><?= $q->jenis_kamar ?></td>
            <td><?= $q->harga_n ?></td>
            <td>
              <?= $get_k ?>
            </td>

            <td><?= $q->harga_days ?></td>
            <td><?= $q->harga_end ?></td>
            <td><?= $q->harga_long ?></td>
            <td><?= $bed ?></td>
            <td><?= $ot ?></td>
            <td><?= $ot1 ?></td>

            <td><button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#myfbl<?= $q->id_jkamar ?>">
                <span class="glyphicon glyphicon-pencil"></span>
              </button> <a type="submit" class="btn btn-danger btn-xs" onclick="return confirm('Anda Yakin?')" href="<?= base_url('C_admin/dell_kamar/' . $q->id_jkamar) ?>">
                <span class="glyphicon glyphicon-remove"></span>
              </a>
              <!--MODAL EDIT YTAGIHAN-->
              <div class="modal fade" id="myfbl<?= $q->id_jkamar ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                      <h4 class="modal-title" id="myModalLabel">PERBAHARUI HARGA KAMAR </h4>
                    </div>
                    <div class="modal-body">
                      <form class="form-horizontal" role="form" method="post" action="<?= base_url() ?>/C_admin/ubah_hargakamr/<?= $q->id_jkamar ?>">
                        <ul class="list-group">
                          <li href="#" class="list-group-item">
                            <p class="list-group-item-text">

                            <div class="form-group">
                              <label for="inputEmail3" class="col-sm-4 control-label">
                                <p class="text-left">Jenis Kamar </p>
                              </label>
                              <div class="col-sm-8">
                                <input type="Text" name="jenis" class="form-control" id="inputEmail3" value="<?= $q->jenis_kamar ?>">
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="inputEmail3" class="col-sm-4 control-label">
                                <p class="text-left">Harga Normal</p>
                              </label>
                              <div class="col-sm-8">
                                <input type="number" min="0" name="harga_n" class="form-control" id="inputEmail3" value="<?= $q->harga_n ?>">
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="inputEmail3" class="col-sm-4 control-label">
                                <p class="text-left">Harga Peake Season</p>
                              </label>
                              <div class="col-sm-8">
                                <input type="number" min="0" name="harga" class="form-control" id="inputEmail3" value="<?= $get_k ?>">
                              </div>
                            </div>

                            <div class="form-group">
                              <label for="inputEmail3" class="col-sm-4 control-label">
                                <p class="text-left">Harga weekdays</p>
                              </label>
                              <div class="col-sm-8">
                                <input type="number" min="0" name="harga_days" class="form-control" id="inputEmail3" value="<?= $q->harga_days  ?>">
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="inputEmail3" class="col-sm-4 control-label">
                                <p class="text-left">Harga weekend</p>
                              </label>
                              <div class="col-sm-8">
                                <input type="number" min="0" name="harga_end" class="form-control" id="inputEmail3" value="<?= $q->harga_end  ?>">
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="inputEmail3" class="col-sm-4 control-label">
                                <p class="text-left">Harga longweekend</p>
                              </label>
                              <div class="col-sm-8">
                                <input type="number" min="0" name="harga_long" class="form-control" id="inputEmail3" value="<?= $q->harga_long  ?>">
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="inputEmail3" class="col-sm-4 control-label">
                                <p class="text-left">Harga Bed</p>
                              </label>
                              <div class="col-sm-8">
                                <input type="number" min="0" name="b" class="form-control" id="inputEmail3" value="<?= $bed ?>">
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="inputEmail3" class="col-sm-4 control-label">
                                <p class="text-left">Harga Overtime <br /><small>max 3 jam</small></p>
                              </label>
                              <div class="col-sm-8">
                                <input type="number" min="0" name="o" class="form-control" id="inputEmail3" value="<?= $ot ?>">
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="inputEmail3" class="col-sm-4 control-label">
                                <p class="text-left">Harga Harga Overtime <small>4-6 jam</small></p>
                              </label>
                              <div class="col-sm-8">
                                <input type="number" min="0" name="t" class="form-control" id="inputEmail3" value="<?= $ot1 ?>">
                              </div>
                            </div>



                            </p>
                          </li>


                          <li href="#" class="list-group-item">

                            <button type="submit" class="btn btn-success btn-block btn-lg">SIMPAN</button>

                          </li>
                        </ul>
                      </form>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    </div>
                  </div>
                </div>
              </div>
            </td>
          </tr>
        <?php  }
        ?>

      </table>
    </table>
  </div>
</div><!-- /.container -->



<div class="container panel">
  <div class="table-responsive panel-body">

    <table class="table"><br />
      <h4 class="well">Daftar Kamar</h4>
      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myfblpluskm">
        <span class="glyphicon glyphicon-plus"></span> Tambah kamar
      </button>
      <br />
      <br />
      <table class="table table-striped table-hover">
        <tr>
          <th>No.</th>
          <th>No. Kamar</th>
          <th>Jenis Kamar</th>
          <th>Menu</th>
        </tr>
        <?php
        $get = $this->Madmin->geg_all_kamar();

        $no = 1;
        foreach ($get->result() as $q) {


        ?>
          <tr>
            <td><?= $no++ ?></td>
            <td><?= $q->id_kamar ?></td>
            <td><?= $q->jenis_kamar ?></td>

            <td><button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#myfbld<?= $q->id_kamar ?>">
                <span class="glyphicon glyphicon-pencil"></span>
              </button> <a type="submit" class="btn btn-danger btn-xs" onclick="return confirm('Anda Yakin?')" href="<?= base_url('C_admin/dell_listkamar/' . $q->id_kamar) ?>">
                <span class="glyphicon glyphicon-remove"></span>
              </a>
              <!--MODAL EDIT YTAGIHAN-->
              <div class="modal fade" id="myfbld<?= $q->id_kamar ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                      <h4 class="modal-title" id="myModalLabel">PERBAHARUI HARGA KAMAR </h4>
                    </div>
                    <div class="modal-body">
                      <form class="form-horizontal" role="form" method="post" action="<?= base_url() ?>/C_admin/ubah_kamar/<?= $q->id_kamar ?>">
                        <ul class="list-group">
                          <li class="list-group-item">
                            <p class="list-group-item-text">

                            <div class="form-group">
                              <label for="inputEmail3" class="col-sm-4 control-label">
                                <p class="text-left">Jenis Kamar </p>
                              </label>
                              <div class="col-sm-8">
                                <select name="jenis" class="form-control">
                                  <?php
                                  $jkol = $this->Mhotel->getjenis_kamar();
                                  foreach ($jkol->result() as $jen) {

                                    if ($jen->id_jkamar == $q->id_jkamar) {
                                      $ak = 'selected';
                                    } else {
                                      $ak = '';
                                    }
                                  ?>
                                    <option value="<?= $jen->id_jkamar ?>" <?= $ak ?>><?= $jen->jenis_kamar ?></option>
                                  <?php }
                                  ?>


                                </select>

                              </div>
                            </div>
                            <div class="form-group">
                              <label for="inputEmail3" class="col-sm-4 control-label">
                                <p class="text-left">No. Kamar </p>
                              </label>
                              <div class="col-sm-8">
                                <input type="Text" name="no" class="form-control" value="<?= $q->id_kamar ?>" id="inputEmail3">
                              </div>
                            </div>



                            </p>
                          </li>


                          <li class="list-group-item">

                            <button type="submit" class="btn btn-success btn-block btn-lg">SIMPAN</button>

                          </li>
                        </ul>
                      </form>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    </div>
                  </div>
                </div>
              </div>
            </td>
          </tr>
        <?php  }
        ?>

      </table>
    </table>
  </div>
</div><!-- /.container -->

<!--PLUS JENS KAMAR-->
<div class="modal fade" id="myfblplus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">TAMBAH JENIS KAMAR</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" role="form" method="post" action="<?= base_url() ?>/C_admin/plus_jenis_kamr">
          <ul class="list-group">
            <li href="#" class="list-group-item">
              <p class="list-group-item-text">

              <div class="form-group">
                <label for="inputEmail3" class="col-sm-4 control-label">
                  <p class="text-left">Jenis Kamar </p>
                </label>
                <div class="col-sm-8">
                  <input type="Text" name="jenis" class="form-control" id="inputEmail3">
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-4 control-label">
                  <p class="text-left">Harga</p>
                </label>
                <div class="col-sm-8">
                  <input type="number" min="0" name="harga" class="form-control" id="inputEmail3">
                </div>
              </div>






              </p>
            </li>


            <li href="#" class="list-group-item">

              <button type="submit" class="btn btn-success btn-block btn-lg">SIMPAN</button>

            </li>
          </ul>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
      </div>
    </div>
  </div>
</div>
<!--PLUS KAMAR-->
<div class="modal fade" id="myfblpluskm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">TAMBAH KAMAR</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" role="form" method="post" action="<?= base_url() ?>/C_admin/plus_list_kamr/">
          <ul class="list-group">
            <li class="list-group-item">
              <p class="list-group-item-text">

              <div class="form-group">
                <label for="inputEmail3" class="col-sm-4 control-label">
                  <p class="text-left">Jenis Kamar </p>
                </label>
                <div class="col-sm-8">
                  <select name="jenis" class="form-control">
                    <?php
                    $jkol = $this->Mhotel->getjenis_kamar();
                    foreach ($jkol->result() as $jen) {
                    ?>
                      <option value="<?= $jen->id_jkamar ?>"><?= $jen->jenis_kamar ?></option>
                    <?php }
                    ?>


                  </select>

                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-4 control-label">
                  <p class="text-left">No. Kamar </p>
                </label>
                <div class="col-sm-8">
                  <input type="number" min="0" name="no" class="form-control" id="inputEmail3">
                </div>
              </div>








              </p>
            </li>


            <li href="#" class="list-group-item">

              <button type="submit" class="btn btn-success btn-block btn-lg">SIMPAN</button>

            </li>
          </ul>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
      </div>
    </div>
  </div>
</div>