<!---->
<?php
//=========================================================================================SIM 10417
if ($sm == 'ya') {
	$totd = $this->Mhotel->total_deposit_sim($id_p); /////tidak deposit total yag di payment
	$totdll = $this->Mhotel->total_all_sim($id_p); ////menggunakan deposit total yag di payment /alll semua deposit
} else {
	$totd = $this->Mhotel->total_deposit($id_p); /////tidak deposit total yag di payment
	$totdll = $this->Mhotel->total_all($id_p); ////menggunakan deposit total yag di payment /alll semua deposit
}
//=========================================================================================SIM 10417

?>
<?php



if ($h_row->disc == 'active') {
	// $disckam=$totdisc-($totdisc/20); ////member only ..///yang di disconkn kamar tooo hasil akhir
	$disckam = $totdisc / 20; ////member only ..///yang di disconkn kamar tooo
	$active = 'Non active';
	$span = 'remove-sign';
	$hrf = 'NULL';
} else {
	$active = 'active';
	$span = 'ok-circle';
	$hrf = 'active';
	$disckam = 0;
}
///=========================================================================================================
$paymentall = $p - $disckam; ////tagihankamar dan dapur dikurangi disckon
$totalall = $totdll - $paymentall; ////untiuk total ////uang yang di bayar di kurangi tagihan kamar
////
////untuk mecari total dep
///====================================================================REFUNT UPDATE




///====================================================================REFUNT UPDATE
///
$rto = $totalall;
//
if ($totdll >= $paymentall) { ///==================================lunas LUNAS money-tagihanW

	//=========================================================================================SIM 10417
	if ($sm == 'ya') {
		$this->Mhotel->lunas_sim($id_p, 'Lunas');
	} else {
		$this->Mhotel->lunas($id_p, 'Lunas');
	}
	//=========================================================================================SIM 10417



	//////===================================================refun	
	if ($rto >= '1') {
		if ($h_row->refund_status == 'lunas') {

			//=========================================================================================SIM 10417
			if ($sm == 'ya') {
				$this->Mhotel->okrefundpas_sim($id_p, 'ok'); ///U* KEPERLUAN GET DATA LAPORAN
				//====================================TAGIHAN
				$this->Mhotel->lunastagihan_sim($id_p, 'Lunas');
				//=====================================
			} else {
				$this->Mhotel->okrefundpas($id_p, 'ok'); ///U* KEPERLUAN GET DATA LAPORAN
				//====================================TAGIHAN
				$this->Mhotel->lunastagihan($id_p, 'Lunas');
				//=====================================
			}
			//=========================================================================================SIM 10417


		} else {


			//=========================================================================================SIM 10417
			if ($sm == 'ya') {
				$this->Mhotel->okrefund_sim($id_p, 'tdk');
				//====================================TAGIHAN
				$this->Mhotel->lunastagihan_sim($id_p, 'Tagihan');
				//=====================================
			} else {
				$this->Mhotel->okrefund($id_p, 'tdk');
				//====================================TAGIHAN
				$this->Mhotel->lunastagihan($id_p, 'Tagihan');
				//=====================================
			}
			//=========================================================================================SIM 10417


		}
	} elseif ($rto == 0) {
		//=========================================================================================SIM 10417
		if ($sm == 'ya') {
			$this->Mhotel->okrefundpas_sim($id_p, 'pas');
			//====================================TAGIHAN
			$this->Mhotel->lunastagihan_sim($id_p, 'Lunas');
			//=====================================
		} else {
			$this->Mhotel->okrefundpas($id_p, 'pas');
			//====================================TAGIHAN
			$this->Mhotel->lunastagihan($id_p, 'Lunas');
			//=====================================
		}
		//=========================================================================================SIM 10417

	} else {

		//=========================================================================================SIM 10417
		if ($sm == 'ya') {
			$this->Mhotel->okrefund_sim($id_p, 'tdk'); /////tbl_pesan_kamar
			///==========================================TAGIHAN BELUM MUNCUL
			$this->Mhotel->lunastagihan_sim($id_p, 'Tagihan');
			///==========================================TAGIHAN BELUM MUNCUL


		} else {
			$this->Mhotel->okrefund($id_p, 'tdk'); /////tbl_pesan_kamar
			///==========================================TAGIHAN BELUM MUNCUL
			$this->Mhotel->lunastagihan($id_p, 'Tagihan');
			///==========================================TAGIHAN BELUM MUNCUL

			///==========================================TAGIHAN dI lapoRAN tUNGGAKAN
			$this->Mhotel->lunastunggakan($id_p, 'Tunggakan');
			///==========================================TAGIHAN dI lapoRAN tUNGGAKAN
		}
		//=========================================================================================SIM 10417



	}


	//////////REFUN WARNA

	///rev10317

	//=========================================================================================SIM 10417
	if ($sm == 'ya') {
		$h_row = $this->db->get_where('tbl_pesan_kamar_sim', array('id' => $id_p))->row();
	} else {
		$h_row = $this->db->get_where('tbl_pesan_kamar', array('id' => $id_p))->row();
	}
	//=========================================================================================SIM 10417

	if ($h_row->refund == 'pas') {
		$warna = '#4bd853';	//sukses
		$wt = 'success';

		///========================================UPDATE RESEPSIONIS MENERIMA UANG===========================================

		//=========================================================================================SIM 10417
		if ($sm == 'ya') {
			if (empty($this->Mhotel->gettglpesakamar_sim($id_p)->row()->id_tgl)) {
				$this->Mhotel->tgldeposit_sim($id_p);
				$this->Mhotel->tgldeposittagihan_sim($id_p);
			}
		} else {
			if (empty($this->Mhotel->gettglpesakamar($id_p)->row()->id_tgl)) {
				$this->Mhotel->tgldeposit($id_p);
				$this->Mhotel->tgldeposittagihan($id_p);
			}

			///==========================================TAGIHAN dI lapoRAN tUNGGAKAN
			$this->Mhotel->lunastunggakan($id_p, 'Lunas');
			///==========================================TAGIHAN dI lapoRAN tUNGGAKAN


		}
		//=========================================================================================SIM 10417

	} elseif ($h_row->refund == 'ok') {
		$warna = '#4bd853';	//sukses
		$wt = 'success';

		//=========================================================================================SIM 10417
		if ($sm == 'ya') {
			if (empty($this->Mhotel->gettglpesakamar_sim($id_p)->row()->id_tgl)) {
				$this->Mhotel->tgldeposit_sim($id_p);
				$this->Mhotel->tgldeposittagihan_sim($id_p);
			}
		} else {
			if (empty($this->Mhotel->gettglpesakamar($id_p)->row()->id_tgl)) {
				$this->Mhotel->tgldeposit($id_p);
				$this->Mhotel->tgldeposittagihan($id_p);
			}

			///==========================================TAGIHAN dI lapoRAN tUNGGAKAN
			$this->Mhotel->lunastunggakan($id_p, 'Lunas');
			///==========================================TAGIHAN dI lapoRAN tUNGGAKAN


		}
		//=========================================================================================SIM 10417	

	} else {
		$warna = '#faf429'; ///warning
		$wt = '';
	}
} else {
	////tagihan
	//=========================================================================================SIM 10417
	if ($sm == 'ya') {
		$this->Mhotel->lunas_sim($id_p, 'Tagihan');
		$this->Mhotel->lunastagihan_sim($id_p, 'Tagihan');
		$this->Mhotel->okrefund_sim($id_p, 'tdk'); /////tbl_pesan_kamar
	} else {
		$this->Mhotel->lunas($id_p, 'Tagihan');
		$this->Mhotel->lunastagihan($id_p, 'Tagihan');
		$this->Mhotel->lunasrefund($id_p, 'Tagihan');
		$this->Mhotel->okrefund($id_p, 'tdk'); /////tbl_pesan_kamar
	}
	//=========================================================================================SIM 10417


	$wt = 'danger';
	$warna = '#ff0000';
}

?>

<!---->


<div class="container" style="background-color: #dddde1">



	<div class="panel panel-primary">
		<div class="panel-heading">
			<h3 class="panel-title">
				<div class="page-header">
					<h3>GUEST BILL</h3>
				</div>

			</h3>

		</div>
		<div class="panel-body">
			<?php if ('kosong' != 'kosong') {
				echo '<p class="text-denger"  style="color: #ff0000">Nama ' . $this->session->userdata('nama') . 'Tidak Terdaftar</p>';
			} else { ?>
				<div class="table-responsive">
					<?php if ($noedit != 'ya') { ?>

						<p class="pull-right">
						<div class="btn-group">
							<?php
							if ($sm == 'ya') { ?>
								<a class="btn btn-xs btn-danger" href="<?= base_url() ?>C_cetak_sim/cetak_bill_sim/pdf/<?= $id_p ?>/ya"><span class="excel"> </span> PDF</a>
								<a class="btn btn-xs btn-success" href="<?= base_url() ?>C_cetak_sim/cetak_bill_sim/xls/<?= $id_p ?>/ya"><span class="excel"> </span> XLS</a>
								<a class="btn btn-xs btn-warning" target="output" href="<?= base_url() ?>C_cetak_sim/cetak_bill_sim/html/<?= $id_p ?>/ya"><span class="glyphicon glyphicon-print"> Print</span></a>
							<?php } else { ?>
								<a class="btn btn-xs btn-danger" href="<?= base_url() ?>C_cetak/cetak_bill/pdf/<?= $id_p ?>"><span class="excel"> </span> PDF</a>
								<a class="btn btn-xs btn-success" href="<?= base_url() ?>C_cetak/cetak_bill/xls/<?= $id_p ?>"><span class="excel"> </span> XLS</a>
								<a class="btn btn-xs btn-warning" target="output" href="<?= base_url() ?>C_cetak/cetak_bill/html/<?= $id_p ?>"><span class="glyphicon glyphicon-print"> Print</span></a>
							<?php
							}

							?>


							<!--</ul>-->
						</div>
						</p>
					<?php } ?>
					<?php if ($noedit != 'ya') { ?>
						<div class="pull-right text-muted" align="right"><?= $h_row->user ?> <?= $h_row->update ?></div>
					<?php	} ?>

					<!--INPUT DEPOSIT-->
					<div class="row">

						<div class="col-sm-12 col-md-12">
							<table class="table table-striped table-hover table-condensed table-responsive table-bordered">
								<tr>
									<th class="warning">Name <span class=pull-right>
											<?php if ($wt == 'success') {
											} else { ?>
												<a data-toggle="modal" data-target="#myModaleditbama" href=""><span class="glyphicon glyphicon-pencil"> </span></a>
											<?php } ?>

											<!-- Modal non cas deposit---------OK---------------->
											<div class="modal fade" id="myModaleditbama" tabindex="-1">
												<div class="modal-dialog">
													<div class="modal-content">
														<div class="modal-header">
															<button type="button" class="close" data-dismiss="modal">&times;</button>
															<h4 class="modal-title" id="myModalLabel">Edit Profil</h4>
														</div>
														<div class="modal-body">

															<!--rev ilham 3/2/27-->
															<?php
															//=========================================================================================SIM 10417
															if ($sm == 'ya') {
															?>
																<form class="form-inline" action="<?= base_url() ?>C_resepsionis_sim/simpan_editnama_sim/<?= $id_p ?>/<?= $sm ?>" method="post">
																<?php } else { ?>
																	<form class="form-inline" action="<?= base_url() ?>C_resepsionis/simpan_editnama/<?= $id_p ?>/" method="post">
																	<?php	}
																//=========================================================================================SIM 10417

																	?>




																	<div class="form-group">
																		<label for="" class="label-control"> Nama </label><br />
																		<div class="input-group">
																			<span class="input-group-addon"> <span class="glyphicon glyphicon-user"></span></span>
																			<input type="text" name="nama" placeholder="Nama" value="<?= $h_row->nama ?>" class="form-control">
																			<span class="input-group-btn">
																			</span>
																		</div><!-- /input-group -->

																	</div>
																	<hr />
																	<div class="form-group">
																		<label for="" class="label-control"> Alamat </label><br />
																		<div class="input-group">
																			<span class="input-group-addon"> <span class="glyphicon glyphicon-map-marker"></span></span>
																			<input type="text" name="alamat" placeholder="Alamat" value="<?= $h_row->alamat ?>" class="form-control">
																			<span class="input-group-btn">
																			</span>
																		</div><!-- /input-group -->

																	</div>
																	<hr />
																	<div class="form-group">
																		<label for="" class="label-control">Time Check in </label><br />
																		<input type="hidden" name="cekin" value="<?= substr($h_row->cekin, 0, 11) ?>">
																		<input type="time" name="time_in" value="<?= substr($h_row->cekin, '11') ?>" class="form-control">
																	</div>

																	<div class="form-group">
																		<input type="hidden" name="cekout" value="<?= substr($h_row->cekout, 0, 11) ?>">
																		<label for="" class="label-control">Time Check out </label><br />
																		<input type="time" name="time_out" value="<?= substr($h_row->cekout, '11') ?>" class="form-control">
																	</div>
																	<hr />

																	<div class="form-group">
																		<button class="btn btn-default " type="submit">Simpan</button>
																	</div>
																	</form>
														</div>
													</div>
												</div>
											</div>


										</span></th>
									<th colspan="8"><?= $h_row->nama ?></th>
								</tr>
								<tr>
									<td class="warning">Address</td>
									<td colspan="8"><?= $h_row->alamat ?></td>
								</tr>
								<tr>
									<td class="warning">Check in</td>
									<td class="success">date</td>
									<td><?php
										///=================================================CEK in==============================ok==============================
										///=================================================SIM ============================================================
										if ($sm == 'ya') {
											$g_id_min = $this->Mhotel->get_tbl_bill_tgl_min_sim($id_p)->row();
										} else {
											$g_id_min = $this->Mhotel->get_tbl_bill_tgl_min($id_p)->row();
										}
										///=================================================SIM ============================================================

										$sorttmin = $g_id_min->sort_t;
										$xxxm = substr($sorttmin, '0', '4');
										$xxm = substr($sorttmin, '4', '2');
										$xm = substr($sorttmin, '6', '2');
										echo  $xm . '-' . $xxm . '-' . $xxxm;
										?>

									</td>
									<td class="success">time</td>
									<td colspan="2"><?= substr($h_row->cekin, '11') ?></td>
									<td colspan="3"></td>
								</tr>
								<?PHP //===========================================cek OUT=================ok===============================================
								?>
								<tr>
									<td class="warning">Check out</td>
									<td class="success">date</td>
									<td><?php
										///=================================================SIM ============================================================
										if ($sm == 'ya') {
											$g_id_mak = $this->Mhotel->get_tbl_perpanjang_mak_sim($id_p)->row();
											$g_id_mak_bill = $this->Mhotel->get_tbl_perpanjang_mak_new_sim($id_p)->row();
										} else {
											$g_id_mak = $this->Mhotel->get_tbl_perpanjang_mak($id_p)->row();
											$g_id_mak_bill = $this->Mhotel->get_tbl_perpanjang_mak_new($id_p)->row();
										}
										///=================================================SIM ============================================================


										if (empty($g_id_mak->cekout)) {
											$sortt = $g_id_mak_bill->sort_t + 1;
										} else {
											$sortt = $g_id_mak->cekout;
										}

										$xxx = substr($sortt, '0', '4');
										$xx = substr($sortt, '4', '2');
										$x = substr($sortt, '6', '2');
										echo  $x . '-' . $xx . '-' . $xxx;

										//substr($h_row->cekin,'0','-6')
										?></td>
									<td class="success">time</td>
									<td colspan="2"><?= substr($h_row->cekout, '11') ?></td>
									<td colspan="3"></td>

								</tr>
								<tr>
									<td colspan="9"></td>
								</tr>
							</table>
						</div>

						<div class="col-sm-6 col-md-7">
							<table class="table table-striped table-hover table-condensed table-responsive table-bordered">

								<tr>
									<td>
										<?php if ($wt == 'success') {
										} else { ?>
											<a class="btn btn-primary btn-xs" href="<?= base_url('C_resepsionis_sim/s_deposit_sim/' . $id_p . '/' . $sm) ?>"><span class="glyphicon glyphicon-plus"> Tambah</span></a>
										<?php }
										?>
									</td>
									<td class="warning">Date</td>
									<td class="warning">No. Nota</td>
									<td class="warning">Trnsfr (Rp)</td>
									<td class="warning">Cash (Rp)</td>
								</tr>


								<?php
								if ($sm == 'ya') {
									$d = $this->Mhotel->get_all_deposit_total_sim($id_p);
								} else {
									$d = $this->Mhotel->get_all_deposit_total($id_p);
								}

								$no = 1;
								foreach ($d->result() as $dep) { ?>
									<tr>
										<td class="success">Deposit <?= $no++ ?></td>
										<td><?= $dep->tanggal ?></td>
										<td><?= $dep->nota ?></td>
										<td>
											<p align="right">
												<?php
												echo !empty($dep->transfer) ? number_format($dep->transfer, 0, ',', '.') : '';
												/////////////////////

												if (empty($dep->transfer) and $dep->transfer != 0 or !empty($dep->cas)) { ?>

													<?php } else {

													if ($wt == 'success') {
													} else { ?>
														<a data-toggle="modal" data-target="#myModaltransferup<?= $dep->id ?>" href=""><span class="glyphicon glyphicon-pencil"> </span></a>
														<!-- Modal non cas deposit-------------ok------------>
											<div class="modal fade" id="myModaltransferup<?= $dep->id ?>" tabindex="-1">
												<div class="modal-dialog">
													<div class="modal-content">
														<div class="modal-header">
															<button type="button" class="close" data-dismiss="modal">&times;</button>
															<h4 class="modal-title" id="myModalLabel">TRANSFER</h4>
														</div>
														<div class="modal-body">

															<!--rev ilham 3/2/27-->
															<?php
															//=========================================================================================SIM 10417
															if ($sm == 'ya') {
															?>
																<form class="form-inline" action="<?= base_url() ?>C_resepsionis_sim/up_transfer_dep_sim/<?= $id_p ?>/<?= $dep->id ?>/<?= $sm ?>" method="post">
																<?php } else { ?>
																	<form class="form-inline" action="<?= base_url() ?>C_resepsionis/up_transfer_dep/<?= $id_p ?>/<?= $dep->id ?>" method="post">
																	<?php	}
																//=========================================================================================SIM 10417

																	?>




																	<div class="form-group">
																		<label for="" class="label-control"> Date </label><br />
																		<div class="input-group" id="datetimepicker8">
																			<span class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span></span>
																			<input type="text" name="date" placeholder="<?= date('d-m-Y') ?>" value="<?= $dep->tanggal ?>" class="form-control" required>
																			<span class="input-group-btn">
																			</span>
																		</div><!-- /input-group -->

																	</div>
																	<hr />
																	<div class="form-group">
																		<label for="">NOMINAL </label><br />
																		<div class="input-group">
																			<span class="input-group-addon">Rp : </span>
																			<input type="number" min="0" class="form-control" name="cas_t" placeholder="-" value="<?php echo !empty($dep->transfer) ? $dep->transfer : ''; ?>" autofocus required>

																		</div><!-- /input-group -->

																	</div>
																	<hr />
																	<div class="form-group">

																		<label for="">No. Nota </label><br />
																		<div class="input-group">
																			<span class="input-group-addon">No. </span>
																			<input type="text" class="form-control" name="nota" placeholder=" Nota" value="<?= $dep->nota ?>" autofocus>
																			<span class="input-group-btn">

																			</span>
																		</div><!-- /input-group -->


																	</div><br />
																	<hr />
																	<div class="form-group">
																		<button class="btn btn-default " type="submit">Simpan</button>
																	</div>
																	</form>
														</div>
													</div>
												</div>
											</div>
										<?php } ?>

									<?php	} ?>

									</p>
										</td>
										<td>
											<p align="right"><?php if (!empty($dep->cas)) {
																	echo !empty($dep->cas) ? number_format($dep->cas, 0, ',', '.') : '0';
																	//echo number_format($dep->cas,0,',','.');
																} ?>
												<?php if (empty($dep->cas) and $dep->cas != 0 or !empty($dep->transfer)) { ?>
												<?php } else {  ?>
													<?php if ($wt == 'success') {
													} else { ?>
														<a data-toggle="modal" data-target="#myModalcasup<?= $dep->id ?>" href=""><span class="glyphicon glyphicon-pencil"> </span></a>
														<!-- Modal cas deposuit -------------------------------ok------ -->
											<div class="modal fade" id="myModalcasup<?= $dep->id ?>" tabindex="-1">
												<div class="modal-dialog">
													<div class="modal-content">
														<div class="modal-header">
															<button type="button" class="close" data-dismiss="modal">&times;</button>
															<h4 class="modal-title" id="myModalLabel">CASH</h4>
														</div>
														<div class="modal-body">
															<?php
															//=========================================================================================SIM 10417
															if ($sm == 'ya') {
															?>
																<form class="form-inline" action="<?= base_url() ?>C_resepsionis_sim/up_transfer_dep_sim/<?= $id_p ?>/<?= $dep->id ?>/<?= $sm ?>" method="post">
																<?php } else { ?>
																	<form class="form-inline" action="<?= base_url() ?>C_resepsionis/up_transfer_dep/<?= $id_p ?>/<?= $dep->id ?>" method="post">
																	<?php	}
																//=========================================================================================SIM 10417

																	?>



																	<div class="form-group">
																		<label for="" class="label-control"> Date </label><br />
																		<div class="input-group" id="datetimepicker8">
																			<span class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span></span>
																			<input type="text" name="date" placeholder="<?= date('d-m-Y') ?>" value="<?= $dep->tanggal ?>" class="form-control" required>
																			<span class="input-group-btn">
																			</span>
																		</div><!-- /input-group -->

																	</div>
																	<hr />
																	<div class="form-group">
																		<label for="">NOMINAL </label><br />
																		<div class="input-group">
																			<span class="input-group-addon">Rp : </span>
																			<input type="number" min="0" class="form-control" name="cas" placeholder="-" value="<?php echo !empty($dep->cas) ? $dep->cas : ''; ?>" autofocus required>

																		</div><!-- /input-group -->

																	</div>
																	<hr />
																	<div class="form-group">

																		<label for="">No. Nota </label><br />
																		<div class="input-group">
																			<span class="input-group-addon">No. </span>
																			<input type="text" class="form-control" name="nota" placeholder=" Nota" value="<?= $dep->nota ?>" autofocus>
																			<span class="input-group-btn">

																			</span>
																		</div><!-- /input-group -->


																	</div><br />
																	<hr />
																	<div class="form-group">
																		<button class="btn btn-default " type="submit">Simpan</button>
																	</div>
																	</form>

														</div>
													</div>
												</div>
											</div>
										<?php } ?>

									<?php	} ?>
									</p>
										</td>
									</tr>
								<?php	} ?>



							</table>
						</div>
						<!--REFUND PAYMENT-->
						<div class="col-sm-6 col-md-5">
							<table class="table table-striped table-hover table-condensed table-responsive table-bordered">
								<tr>
									<td class="success">Amount</td>
									<td align="right" colspan="2"><?= number_format($p, 0, ',', '.') ?></td>
								</tr>
								<tr>
									<td class="success">Disc. Member
										<?php if ($wt != 'success') { ?>
											<?php
											//=========================================================================================SIM 10417
											if ($sm == 'ya') {
											?>
												<span class="pull-right"><a href="<?= base_url('C_resepsionis_sim/gift_sim/' . $hrf . '/' . $id_p . '/' . $sm) ?>"><span class="glyphicon glyphicon-<?= $span ?>"></span> <?= $active ?></a> </span>
											<?php } else { ?>
												<span class="pull-right"><a href="<?= base_url('C_resepsionis/gift/' . $hrf . '/' . $id_p) ?>"><span class="glyphicon glyphicon-<?= $span ?>"></span> <?= $active ?></a> </span>
											<?php	}
											//=========================================================================================SIM 10417

											?>

										<?php } ?>
									</td>
									<td align="right" colspan="2"><?php

																	if ($disckam != 0) {
																		echo number_format($disckam, 0, ',', '.');
																	}

																	?></td>
								</tr>
								<!--<tr>
		<td class="success" >Temporary Payment </td>
		<td  align="right"><?= number_format($payment, 0, ',', '.') ?> </td>
	</tr>-->
								<tr>
									<td class="success">Deposit <span class="pull-right"></span></td>
									<td align="right" colspan="2">
										<?php
										if ($totd != 0) {
											echo number_format($totd, 0, ',', '.');
										}
										?>
									</td>
								</tr>
								<tr>

									<td class="warning"><?php if ($totalall > 0) {
															echo 'Refund';
														} else {
															echo 'Payment';
														}
														////jjika refun ga mucul 4/3/17
														if ($totalall < 0) {  ?>
											<?php if ($wt == 'success') {
															} else { ?>
												<span class="pull-right"><a data-toggle="modal" data-target="#myModalTotal" href=""><span class="glyphicon glyphicon-pencil"> </span></a></span>

												<!-- Modal pelunasan cas dan non cas -->
												<div class="modal fade" id="myModalTotal" tabindex="-1">
													<div class="modal-dialog">
														<div class="modal-content">
															<div class="modal-header">
																<button type="button" class="close" data-dismiss="modal">&times;</button>
																<h4 class="modal-title" id="myModalLabel">Total Payment </h4>
															</div>
															<div class="modal-body">
																<?php
																//=========================================================================================SIM 10417
																if ($sm == 'ya') {
																?>
																	<form class="form-inline" action="<?= base_url() ?>C_resepsionis_sim/up_transfer_sim/<?= $id_p ?>/<?= $totid + 1 ?>/<?= $sm ?>" method="post">
																	<?php } else { ?>
																		<form class="form-inline" action="<?= base_url() ?>C_resepsionis/up_transfer/<?= $id_p ?>/<?= $totid + 1 ?>" method="post">
																		<?php	}
																	//=========================================================================================SIM 10417

																		?>
																		<form class="form-inline" action="<?= base_url() ?>C_resepsionis/up_transfer/<?= $id_p ?>/<?= $totid + 1 ?>/" method="post">

																			<div class="form-group">
																				<label for="" class="label-control"> Total Payment : <?= $totalall ?> </label>
																			</div>
																			<hr />
																			<div class="form-group">
																				<label for="" class="label-control"> Date </label><br />
																				<div class="input-group" id="datetimepicker10">
																					<span class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span></span>
																					<input type="text" name="date" placeholder="<?= date('d-m-Y') ?>" value="<?= date('d-m-Y') ?>" class="form-control">
																					<span class="input-group-btn">
																					</span>
																				</div><!-- /input-group -->

																			</div>

																			<hr />
																			<!---->
																			<div class="form-group">
																				<label for="">NOMINAL </label><br />
																				<div class="input-group">
																					<span class="input-group-addon">Rp :</span>
																					<input type="number" min="0" name="nominal" value="<?= abs($totalall) ?>" placeholder="-" value="" class="form-control" required>
																					<span class="input-group-btn">
																					</span>
																				</div>
																			</div>

																			<hr />

																			<!---->
																			<div class='row'>
																				<div class="col-xs-6">
																					<div class="form-group">
																						<label class="control-label">
																							<p class="text-left">Nama Rekening Pengirim</p>
																						</label>
																						<div class="">
																							<input type="text" name="rek" class="form-control" id="inputEmail3" placeholder="-">
																						</div>

																					</div>
																				</div>
																				<div class="col-xs-6">
																					<label class="control-label">
																						<p class="text-left">BANK</p>
																					</label>
																					<div class="">
																						<select name="bank" class="form-control">
																							<option value="Cash">Cash Money</option>
																							<option value="BCA">BCA</option>
																							<option value="Mandiri">Mandiri</option>

																						</select>

																					</div>
																				</div>

																			</div>

																			<br />
																			<hr />
																			<div class="form-group">
																				<button class="btn btn-default" type="submit">Simpan</button>
																			</div>
																		</form>
															</div>
														</div>
													</div>
												</div>
											<?php } ?>
										<?php } ?>
									</td>
									<td align="right" colspan="2" bgcolor="<?= $warna ?>">
										<?php
										//revisi masterpra:
										//setelah dilunasi, tidak boleh 0 (nol), harus bernilai positif sesuai jumlah pelunasan
										if ($totalall > 0) {
											///echo number_format($this->Mhotel->total_payment_lunas($id_p),0,',','.'); //rev pra
											echo '+' . number_format($totalall, 0, ',', '.'); ////rev ilham  : bila lebih munculkan yang lebihnya pake (+)

										} elseif ($totalall == 0) {

											//=========================================================================================SIM 10417
											if ($sm == 'ya') {
												$getpelunasan = $this->Mhotel->total_payment_lunas_ilham_sim($id_p);
											} else {
												$getpelunasan = $this->Mhotel->total_payment_lunas_ilham($id_p);
											}
											//=========================================================================================SIM 10417	


											echo number_format($getpelunasan, 0, ',', '.');
										} else {
											echo  number_format($totalall, 0, ',', '.');
										}
										?>

									</td>

								</tr>
								<?php
								/////////////REFUND
								if ($totalall > 0) {  ?>
									<?php if ($noedit != 'ya') { ?>
										<tr>
											<td class="warning">Menu</td>
											<?php
											if ($h_row->refund_status == 'lunas') { ?>
												<td colspan="2"><span class="glyphicon glyphicon-ok"></span> OK</td>
											<?php } else {
											?>
												<td align="right">
													<?php
													//=========================================================================================SIM 10417
													if ($sm == 'ya') {
													?>
														<a href="<?= base_url('C_resepsionis_sim/refund_sim/' . $id_p . '/cash/' . $h_row->nama . '/' . $sm) ?>" onclick="return confirm('anda yakin')"><span class="glyphicon glyphicon-ok"></span> Cash</a>
													<?php } else { ?>
														<a href="<?= base_url('C_resepsionis/refund/' . $id_p . '/cash/' . $h_row->nama) ?>" onclick="return confirm('anda yakin')"><span class="glyphicon glyphicon-ok"></span> Cash</a>
													<?php	}
													//=========================================================================================SIM 10417

													?>


												</td>
												<td>
													<span class="pull-right"><a data-toggle="modal" data-target="#myModalefun" href=""><span class="glyphicon glyphicon-ok"> </span> Transfer</a></span>

													<!-- Modal -->
													<div class="modal fade" id="myModalefun" tabindex="-1">
														<div class="modal-dialog">
															<div class="modal-content">
																<div class="modal-header">
																	<button type="button" class="close" data-dismiss="modal">&times;</button>
																	<h4 class="modal-title" id="myModalLabel">Refund Via Transfer</h4>
																</div>
																<div class="modal-body">
																	<?php
																	//======ok===================================================================================SIM 10417
																	if ($sm == 'ya') {
																	?>
																		<form class="form-horizontal" method="post" action="<?= base_url('C_resepsionis_sim/refund_sim/' . $id_p . '/Transfer/' . $h_row->nama . '/' . $sm) ?>">
																		<?php } else { ?>
																			<form class="form-horizontal" method="post" action="<?= base_url('C_resepsionis/refund/' . $id_p . '/Transfer/' . $h_row->nama) ?>">
																			<?php	}
																		//=========================================================================================SIM 10417

																			?>

																			<ul class="list-group">
																				<li class="list-group-item">
																					<p class="list-group-item-text">


																					<div class="form-group">
																						<label for="inputEmail3" class="col-sm-3 control-label">
																							<p class="text-left">Hotel</p>
																						</label>
																						<div class="col-sm-9">
																							<input type="Text" name="hotel" class="form-control" placeholder="-" value="<?= $namapt ?>" id="inputEmail3" readonly>
																						</div>
																					</div>
																					<div class="form-group">
																						<label for="inputEmail3" class="col-sm-3 control-label">
																							<p class="text-left">Note.no </p>
																						</label>
																						<div class="col-sm-9">
																							<input type="Text" name="nota" class="form-control" placeholder="-" id="inputEmail3" required>
																						</div>
																					</div>


																					<div class="form-group">
																						<label for="inputEmail3" class="col-sm-3 control-label">
																							<p class="text-left">Nominal</p>
																						</label>
																						<div class="col-sm-5 ">
																							<div class="input-group">
																								<span class="input-group-addon">Rp : </span>
																								<input type="number" min="0" name="nominal" class="form-control" value="<?= $totalall ?>" placeholder="-" id="inputEmail3" required>
																							</div>
																						</div>
																					</div>
																					<div class="form-group">
																						<label for="inputEmail3" class="col-sm-3 control-label">
																							<p class="text-left">Atas Nama</p>
																						</label>
																						<div class="col-sm-9">
																							<input type="Text" name="anama" class="form-control" placeholder="-" value="<?= $h_row->nama ?>" readonly id="inputEmail3" required>
																						</div>
																					</div>
																					<div class="form-group">
																						<label for="inputEmail3" class="col-sm-3 control-label">
																							<p class="text-left">Tanggal c/i</p>
																						</label>
																						<div class="col-sm-5">
																							<input type="text" name="c/i" id="datetimepicker11" placeholder="<?= date('d-m-Y') ?>" value="<?= substr($h_row->cekin, '0', '-6') ?>" readonly class="form-control date" required>
																						</div>
																					</div>
																					<div class="form-group">
																						<label for="inputEmail3" class="col-sm-3 control-label">
																							<p class="text-left">Tanggal c/o</p>
																						</label>
																						<div class="col-sm-5">
																							<input type="text" name="c/o" id="datetimepicker11" placeholder="<?= date('d-m-Y') ?>" value="<?= substr($h_row->cekout, '0', '-6') ?>" readonly class="form-control date" required>
																						</div>
																					</div>
																					<div class="form-group">
																						<label for="inputEmail3" class="col-sm-3 control-label">
																							<p class="text-left">Type Kamar</p>
																						</label>
																						<div class="col-sm-9">
																							<input type="Text" name="tkamar" class="form-control" placeholder="-" id="inputEmail3" required>
																						</div>
																					</div>
																					<div class="form-group">
																						<label for="inputEmail3" class="col-sm-3 control-label">
																							<p class="text-left">Return Via BANK</p>
																						</label>
																						<div class="col-sm-9">
																							<input type="text" name="bank" class="form-control" placeholder="-" id="inputEmail3" required>
																						</div>
																					</div>
																					<div class="form-group">
																						<label for="inputEmail3" class="col-sm-3 control-label">
																							<p class="text-left">No. Rek</p>
																						</label>
																						<div class="col-sm-9">
																							<input type="Text" name="rek" class="form-control" placeholder="-" id="inputEmail3" required>
																						</div>
																					</div>
																					<div class="form-group">
																						<label for="inputEmail3" class="col-sm-3 control-label">
																							<p class="text-left">Atas Nama</p>
																						</label>
																						<div class="col-sm-9">
																							<input type="Text" name="anama2" class="form-control" placeholder="-" id="inputEmail3" required>
																						</div>
																					</div>
																					<div class="form-group">
																						<label for="inputEmail3" class="col-sm-3 control-label">
																							<p class="text-left">Tanggal Konfirmasi</p>
																						</label>
																						<div class="col-sm-5">
																							<input type="text" name="tglkom" id="datetimepicker11" placeholder="<?= date('d-m-Y') ?>" value="<?= date('d-m-Y') ?>" class="form-control date" required>
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
											<?php } ?>


										</tr>
									<?php } ?>
								<?php } ?>

							</table>
						</div>
					</div>
					<!--lpaoran keuangan kamar // room dan tagihan -->
					<div class="row">

						<div class="col-sm-12 col-md-7">
							<!---->
							<?php if ($wt != 'success') { ?>
								<p class="pull-right">
								<div class="btn-group">
									<button type="button" class="btn btn-info btn-md" data-toggle="modal" data-target="#myModalroom">
										<span class="glyphicon glyphicon-plus"></span> Tambah
									</button>
								</div>
								<button type="button" class="btn btn-success btn-md" data-toggle="modal" data-target="#myModalperpanjang">
									<span class="glyphicon glyphicon-plus"></span> Perpanjang
								</button>

								</p>

							<?php	} ?>

							<table class="table table-striped table-hover table-condensed table-responsive table-bordered" style="font-size: 90%" width="100%">
								<tr class="success">
									<td align="center" colspan="9">Room, Bed, & OT</td>
								</tr>
								<tr class="warning">
									<td width="15%">Date</td>
									<td width="17%">Type Room.no</td>
									<td>Bed / day</td>
									<td>OT / hours</td>
									<td>DISC</td>
									<td>Early</td>
									<td>Amount</td>
									<td>Balance</td>
									<?php if ($wt != 'success') { ?>
										<td width="16%">Menu</td>
									<?php } ?>

								</tr>
								<?php
								$tot = 0;
								foreach ($h->result() as $hh) {
									//$amm = $this->db->get_where('tbl_pesan_kamar',array('id'=>$hh->id_k));
									$am = $this->M_bill->getPriceRoom($hh->id, $hh->id_k);  ///sama
									if ($hh->ot < 4) {
										$ot = $am->ot;
									} else {
										$ot = $am->ot2;
									}
									//$hhh===tbl--bill---kamar

								?>
									<tr style="font-size: 85%">
										<td><?= $hh->tanggal ?></td>
										<!--HARGA KAMAR-->
										<td>
											<!--rev 7/2/17 penhasan harga kaamar ok remove-->
											<?php
											$dk = $hh->delkam;
											if ($dk == 'ya') {
												$hrgakam = 0;
												$saa = 'remove';
												$lia = '';
											} else {
												$hrgakam = $am->harga;
												$lia = ' (' . number_format($am->harga, 0, ',', '.') . ')';
												$saa = 'ok';
											}
											?>
											<?= $am->room_type ?> <?= $hh->id_k ?> <?= $lia ?>

											<?php if ($wt != 'success') { ?>
												<span class="pull-right">
													<?php
													//================================ok=========================================================SIM 10417
													if ($sm == 'ya') {

														if ($h->num_rows() > 1 or !empty($hh->bed) or !empty($hh->ot) or $hh->early == 1) { ?>
															<a type="submit" class="btn btn-link btn-xs" onclick="return confirm('Anda Yakin ?')" href="<?= base_url('C_resepsionis_sim/hapus_hargakamar_sim/' . $hh->id . '/' . $id_p . '/' . $hh->id_k . '/' . $saa . '/' . $sm) ?>">

																<span class="glyphicon glyphicon-<?= $saa ?>"></span>
															</a>
														<?php
														}
													} else {

														if ($h->num_rows() > 1 or !empty($hh->bed) or !empty($hh->ot) or $hh->early == 1) { ?>

															<a type="submit" class="btn btn-link btn-xs" onclick="return confirm('Anda Yakin ?')" href="<?= base_url('C_resepsionis/hapus_hargakamar/' . $hh->id . '/' . $id_p . '/' . $hh->id_k . '/' . $saa) ?>">
																<span class="glyphicon glyphicon-<?= $saa ?>"></span>
															</a>

													<?php
														}
													}
													//=========================================================================================SIM 10417

													?>


												</span>
											<?php } ?>
										</td>
										<!--BED-->
										<td>
											<?= !empty($hh->bed) ?  $hh->bed . '.(' . number_format($hh->harga_bed, 0, ',', '.') . ')' : '' ?>
											<?php if (empty($hh->bed)) { ?>
												<?php if ($wt != 'success') { ?>
													<button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#mybad<?= $hh->id ?>">
														<span class="glyphicon glyphicon-plus"></span>
													</button>
													<!--MODAL-->
													<div class="modal fade" id="mybad<?= $hh->id ?>" tabindex="-1">
														<div class="modal-dialog">
															<div class="modal-content">
																<div class="modal-header">
																	<button type="button" class="close" data-dismiss="modal">&times;</button>
																	<h4 class="modal-title" id="myModalLabel">Tambah Data Bed</h4>
																</div>
																<div class="modal-body">

																	<ul class="list-group">
																		<?php
																		//================================ok=========================================================SIM 10417
																		if ($sm == 'ya') {
																		?>
																			<form class="form-horizontal" method="post" action="<?= base_url() ?>/C_resepsionis_sim/bed_sim/<?= $hh->id ?>/<?= $id_p ?>/<?= $hh->id_k ?>/<?= $sm ?>">
																			<?php } else { ?>
																				<form class="form-horizontal" method="post" action="<?= base_url() ?>/C_resepsionis/bed/<?= $hh->id ?>/<?= $id_p ?>/<?= $hh->id_k ?>">
																				<?php	}
																			//=========================================================================================SIM 10417

																				?>


																				<li class="list-group-item">
																					<h3>BED</h3>
																				</li>
																				<li class="list-group-item">
																					<p class="list-group-item-text">
																					<div class="form-group">
																						<div class="col-sm-10">
																							<div class="input-group">
																								<input type="number" min="0" name="bed" value="1" class="form-control">
																								<span class="input-group-addon">Bed/day</span>
																							</div>
																							<span>*harga <?= number_format($am->bed, 0, ',', '.') ?></span>

																						</div>
																					</div>


																					<div class="form-group">

																						<div class="col-sm-5">
																							<button type="submit" class="btn btn-success btn-md ">SIMPAN</button>
																						</div>
																					</div>

																					</p>
																				</li>
																				</form>
																	</ul>





																</div>
															</div>
														</div>
													</div>
												<?php } ?>
											<?php	} ?>


										</td>
										<!--OT-->
										<td>
											<?= !empty($hh->ot) ?  $hh->ot . '.(' . number_format($ot, 0, ',', '.') . ')' : '' ?>
											<?php if (empty($hh->ot)) { ?>
												<?php if ($wt != 'success') { ?>
													<button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#myot<?= $hh->id ?>">
														<span class="glyphicon glyphicon-plus"></span>
													</button>
													<!--MODAL-->
													<div class="modal fade" id="myot<?= $hh->id ?>" tabindex="-1">
														<div class="modal-dialog">
															<div class="modal-content">
																<div class="modal-header">
																	<button type="button" class="close" data-dismiss="modal">&times;</button>
																	<h4 class="modal-title" id="myModalLabel">Tambah Data OverTime ( OT)</h4>
																</div>
																<div class="modal-body">

																	<ul class="list-group">
																		<?php
																		//================================ok=========================================================SIM 10417
																		if ($sm == 'ya') {
																		?>
																			<form class="form-horizontal" method="post" action="<?= base_url() ?>/C_resepsionis_sim/ot_sim/<?= $hh->id ?>/<?= $id_p ?>/<?= $hh->id_k ?>/<?= $sm ?>">
																			<?php } else { ?>
																				<form class="form-horizontal" method="post" action="<?= base_url() ?>/C_resepsionis/ot/<?= $hh->id ?>/<?= $id_p ?>/<?= $hh->id_k ?>">
																				<?php	}
																			//=========================================================================================SIM 10417

																				?>

																				<li class="list-group-item">
																					<h3>OverTime</h3>
																				</li>
																				<li class="list-group-item">
																					<p class="list-group-item-text">
																					<div class="form-group">
																						<div class="col-sm-10">
																							<div class="input-group">
																								<input type="number" min="0" name="ot" value="1" class="form-control">
																								<span class="input-group-addon">Hours</span>
																							</div>
																							<span>*harga <?= number_format($am->ot, 0, ',', '.') ?></span>

																						</div>
																					</div>


																					<div class="form-group">

																						<div class="col-sm-5">
																							<button type="submit" class="btn btn-success btn-md ">SIMPAN</button>
																						</div>
																					</div>

																					</p>
																				</li>
																				</form>
																	</ul>





																</div>
															</div>
														</div>
													</div>
												<?php	} ?>
											<?php } ?>

										</td>
										<!--DISC-->
										<td align="right">
											<?php

											//	202012 disc
											$disc = (int)$hh->disc;
											if ($disc > 0) {
												echo number_format($disc, 0, ',', '.');
											}


											?>
										</td>
										<!--EARLY CHECK IN-->
										<td align="right">
											<?php
											$h_kam = $hrgakam;
											if ($hh->early == 1) {
												//$has_early=$h_kam+$bg_kam;
												$bg_kam = ($am->harga / 2); ///rev 11.3.17. ilham haraga kamar tidak pengaruh
												if ($bg_kam > 0) {
													echo number_format($bg_kam, 0, ',', '.');
												}
											} else {
												$bg_kam = '';
											}

											?>
										</td>
										<!--AMOUNT & BALANCE-->
										<td align="right">
											<?php
											$hrgakamdahdisc = (int)$hrgakam - $disc;

											$subtot = (int)$hh->harga_bed + (int)$hh->harga_ot + (int)$bg_kam + (int)$hrgakamdahdisc; //harga bed//harga ot//harga Early///harga kamar 
											$tot = $tot + $subtot;
											//echo number_format($hrgakam,0,',','.');

											echo number_format($subtot, 0, ',', '.');
											?>
										</td>

										<!--penjumlahan ber.ulang-->
										<td align="right"><?= number_format($tot, 0, ',', '.'); ?></td>
										<!--Menu-->
										<?php if ($wt != 'success') { ?>
											<td align="left">

												<button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#myedit<?= $hh->id ?>">
													<span class="glyphicon glyphicon-pencil"></span>
												</button>


												<?php
												//================================ok=========================================================SIM 10417
												if ($sm == 'ya') {
												?>
													<a type="submit" class="btn btn-danger btn-xs" onclick="return confirm('Anda Yakin?')" href="<?= base_url('C_resepsionis_sim/hapus_bill_sim/' . $hh->id . '/' . $id_p . '/' . $hh->id_k . '/' . $hh->sort_t . '/' . $sm) ?>">
														<span class="glyphicon glyphicon-remove"></span>
													</a>
												<?php } else { ?>
													<a type="submit" class="btn btn-danger btn-xs" onclick="return confirm('Anda Yakin?')" href="<?= base_url('C_resepsionis/hapus_bill/' . $hh->id . '/' . $id_p . '/' . $hh->id_k . '/' . $hh->sort_t) ?>">
														<span class="glyphicon glyphicon-remove"></span>
													</a>
												<?php	}
												//=========================================================================================SIM 10417

												?>



												<!--MODAL-->
												<!--MODAL BED OT EARLY DISC KAMAR-->
												<div class="modal fade" id="myedit<?= $hh->id ?>" tabindex="-1">
													<div class="modal-dialog">
														<div class="modal-content">
															<div class="modal-header">
																<button type="button" class="close" data-dismiss="modal">&times;</button>
																<h4 class="modal-title" id="myModalLabel">Edit Data Bed dan Overtime (OT) dan DISC</h4>
															</div>
															<div class="modal-body">

																<ul class="list-group">
																	<?php
																	//================================ok=========================================================SIM 10417
																	if ($sm == 'ya') {
																	?>
																		<form class="form-horizontal" method="post" action="<?= base_url() ?>/C_resepsionis_sim/bed_ot_sim/<?= $hh->id ?>/<?= $id_p ?>/<?= $hh->id_k ?>/<?= $sm ?>">
																		<?php } else { ?>
																			<form class="form-horizontal" method="post" action="<?= base_url() ?>/C_resepsionis/bed_ot/<?= $hh->id ?>/<?= $id_p ?>/<?= $hh->id_k ?>">
																			<?php	}
																		//=========================================================================================SIM 10417

																			?>
																			<li class="list-group-item">
																				<h3>HARGA KAMAR</h3>
																			</li>
																			<li class="list-group-item">
																				<p class="list-group-item-text">
																				<div class="form-group">
																					<div class="col-sm-5">
																						<div class="input-group">
																							<label>
																								<input type="radio" name="harga_kamar" value="0" class="btn btn-sm" <?php if ($am->type == 0) {
																																										echo 'checked';
																																									} ?>> <strong> normal (<?= number_format($am->normal, 0, ',', '.') ?>)</strong>
																							</label>

																						</div>
																					</div>

																					<div class="col-sm-5">
																						<div class="input-group">
																							<label>
																								<input type="radio" name="harga_kamar" value="1" class="btn btn-sm" <?php if ($am->type >= 1) {
																																										echo 'checked';
																																									} ?>> peake sesion (<?= number_format($am->sesion, 0, ',', '.') ?>)
																							</label>
																						</div>
																					</div>

																					<div class="col-sm-5">
																						<div class="input-group">
																							<label>
																								<input type="radio" name="harga_kamar" value="2" class="btn btn-sm" <?php if ($am->type >= 2) {
																																										echo 'checked';
																																									} ?>> weekdays (<?= number_format($am->weekdays, 0, ',', '.') ?>)
																							</label>
																						</div>
																					</div>
																					<div class="col-sm-5">
																						<div class="input-group">
																							<label>
																								<input type="radio" name="harga_kamar" value="3" class="btn btn-sm" <?php if ($am->type >= 3) {
																																										echo 'checked';
																																									} ?>> weekend (<?= number_format($am->weekend, 0, ',', '.') ?>)
																							</label>
																						</div>
																					</div>
																					<div class="col-sm-5">
																						<div class="input-group">
																							<label>
																								<input type="radio" name="harga_kamar" value="4" class="btn btn-sm" <?php if ($am->type >= 4) {
																																										echo 'checked';
																																									} ?>> longweekend (<?= number_format($am->longweekend, 0, ',', '.') ?>)
																							</label>
																						</div>
																					</div>
																				</div>


																				</p>
																			</li>

																			<li class="list-group-item">
																				<h3>BED</h3>
																			</li>
																			<li class="list-group-item">
																				<p class="list-group-item-text">
																				<div class="form-group">
																					<div class="col-sm-10">
																						<div class="input-group">
																							<input type="number" min="0" name="bed" value="<?= $hh->bed ?>" class="form-control">
																							<span class="input-group-addon">Bed / day</span>
																						</div>
																						<span>*harga <?= number_format($am->bed, 0, ',', '.') ?></span>
																					</div>
																				</div>


																				</p>
																			</li>

																			<li class="list-group-item">
																				<h3>OverTime (OT)</h3>
																			</li>
																			<li class="list-group-item">
																				<p class="list-group-item-text">

																				<div class="form-group">
																					<div class="col-sm-10">
																						<div class="input-group">
																							<input type="number" min="0" name="ot" value="<?= $hh->ot ?>" class="form-control">
																							<span class="input-group-addon">Hours</span>
																						</div>
																						<span>*harga <?= number_format($am->ot, 0, ',', '.') ?></span>
																					</div>
																				</div>



																				</p>
																			</li>
																			<li class="list-group-item">
																				<h3>DISC </h3>
																			</li>
																			<li class="list-group-item">
																				<p class="list-group-item-text">

																				<div class="form-group">
																					<?php
																					$pilDisc = 1;
																					if ($hrgakam != 0) {
																						$pilDisc = ($hh->disc * 100) / $hrgakam;
																					}
																					// echo $hrgakam;
																					?>
																					<div class="col-sm-2">
																						<div class="input-group">
																							<label>
																								<input type="radio" name="d10" value="0" class="btn btn-sm" <?php if ($pilDisc == 0) {
																																								echo 'checked';
																																							} ?>> 0
																							</label>
																						</div>
																					</div>

																					<div class="col-sm-2">
																						<div class="input-group">
																							<label>
																								<input type="radio" name="d10" value="10" class="btn btn-sm" <?php if ($pilDisc == 10) {
																																									echo 'checked';
																																								} ?>> 10%
																							</label>
																						</div>
																					</div>
																					<div class="col-sm-2">
																						<div class="input-group">
																							<label>
																								<input type="radio" name="d10" value="20" class="btn btn-sm" <?php if ($pilDisc == 20) {
																																									echo 'checked';
																																								} ?>> 20%
																							</label>
																						</div>
																					</div>
																					<div class="col-sm-2">
																						<div class="input-group">
																							<label>
																								<input type="radio" name="d10" value="30" class="btn btn-sm" <?php if ($pilDisc == 30) {
																																									echo 'checked';
																																								} ?>> 30%
																							</label>
																						</div>
																					</div>


																				</div>

																				<div class="form-group">
																					<div class="col-sm-10">
																						<div class="input-group">
																							<span class="input-group-addon">Rp</span>
																							<input type="number" min="0" name="dnominal" value="<?= (int)$hh->disc ?>" class="form-control">
																						</div>

																					</div>
																				</div>


																				</p>
																			</li>
																			<!---->
																			<li class="list-group-item">
																				<h3>Early Check In </h3>
																			</li>
																			<li class="list-group-item">
																				<p class="list-group-item-text">

																				<div class="form-group">

																					<div class="col-sm-2">
																						<div class="input-group">
																							<label>
																								<input type="radio" name="early" value="0" class="btn btn-sm" <?php if ($hh->early == 0) {
																																									echo 'checked';
																																								} ?>> Tidak</label>
																						</div>
																					</div>
																					<div class="col-sm-2">
																						<div class="input-group">
																							<label>
																								<input type="radio" name="early" value="1" class="btn btn-sm" <?php if ($hh->early == 1) {
																																									echo 'checked';
																																								} ?>> Ya</label>
																						</div>
																					</div>


																				</div>



																				</p>
																			</li>

																			<div class="form-group">

																				<div class="col-sm-12">
																					<button type="submit" class="btn btn-success btn-block btn-md ">Simpan</button>
																				</div>
																			</div>
																			</form>
																</ul>





															</div>
														</div>
													</div>
												</div>

											</td>
										<?php } else {
										?>

										<?php
										}
										?>
										<!--END-->
									</tr>
								<?php	 } ?>


							</table>
						</div>
						<div class="col-sm-12 col-md-5">
							<?php if ($wt != 'success') { ?>
								<p class="pull-right">
								<div class="btn-group">
									<button type="button" class="btn btn-info btn-md" data-toggle="modal" data-target="#myModal">
										<span class="glyphicon glyphicon-plus"></span> Tambah Data
									</button>

								</div>
								</p>
							<?php } ?>
							<table class="table table-striped table-hover table-condensed table-responsive table-bordered" style="font-size: 87%" width="100%">
								<?php
								if ($totdll > $p_kamar) {
									//$this->Mhotel->simpanperbahantipe();
								}
								// $totdll
								?>
								<tr class="success">
									<td align="center" colspan="5">Food, Beverage, Laundry, & Etc</td>
								</tr>
								<tr class="warning">
									<td>Date</td>
									<td>Note.no</td>
									<td>Amount</td>
									<td>Balance</td>
									<?php if ($wt != 'success') { ?>
										<td width="16%">Menu</td>
									<?php } ?>
								</tr>
								<?php $tott = 0;
								foreach ($h1->result() as $hh1) { ?>
									<tr>
										<td><?php echo $hh1->tanggal; ?> </td>
										<td><?= $hh1->nota ?></td>
										<td align="right"><?= number_format($hh1->harga, 0, ',', '.');
															$tott = $tott + $hh1->harga;
															?></td>
										<td align="right"><?= number_format($tott, 0, ',', '.'); ?></td>
										<?php if ($wt != 'success') { ?>
											<td>
												<button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#myfbl<?= $hh1->id ?>">
													<span class="glyphicon glyphicon-pencil"></span>
												</button>
												<?php
												//================================ok=========================================================SIM 10417
												if ($sm == 'ya') {
												?>
													<a type="submit" class="btn btn-danger btn-xs" onclick="return confirm('Anda Yakin?')" href="<?= base_url('C_resepsionis_sim/hapus_tagihan_sim/' . $hh1->id . '/' . $id_p . '/' . $sm) ?>">
														<span class="glyphicon glyphicon-remove"></span>
													</a>
												<?php } else { ?>
													<a type="submit" class="btn btn-danger btn-xs" onclick="return confirm('Anda Yakin?')" href="<?= base_url('C_resepsionis/hapus_tagihan/' . $hh1->id . '/' . $id_p) ?>">
														<span class="glyphicon glyphicon-remove"></span>
													</a>
												<?php	}
												//=========================================================================================SIM 10417

												?>



												<!--MODAL EDIT YTAGIHAN-->
												<div class="modal fade" id="myfbl<?= $hh1->id ?>" tabindex="-1">
													<div class="modal-dialog">
														<div class="modal-content">
															<div class="modal-header">
																<button type="button" class="close" data-dismiss="modal">&times;</button>
																<h4 class="modal-title" id="myModalLabel">EDIT</h4>
															</div>
															<div class="modal-body">
																<?php
																//================================ok=========================================================SIM 10417
																if ($sm == 'ya') {
																?>
																	<form class="form-horizontal" method="post" action="<?= base_url() ?>/C_resepsionis_sim/edit_tagihan_sim/<?= $hh1->id ?>/<?= $id_p ?>/<?= $sm ?>">
																	<?php } else { ?>
																		<form class="form-horizontal" method="post" action="<?= base_url() ?>/C_resepsionis/edit_tagihan/<?= $hh1->id ?>/<?= $id_p ?>">
																		<?php	}
																	//=========================================================================================SIM 10417

																		?>

																		<ul class="list-group">
																			<li class="list-group-item">
																				<p class="list-group-item-text">

																				<div class="form-group">
																					<label for="inputEmail3" class="col-sm-2 control-label">
																						<p class="text-left">Tanggal </p>
																					</label>
																					<div class="col-sm-10">
																						<input type="Text" name="tanggal" class="form-control" id="inputEmail3" placeholder="-" value="<?= $hh1->tanggal ?>">
																					</div>
																				</div>
																				<div class="form-group">
																					<label for="inputEmail3" class="col-sm-2 control-label">
																						<p class="text-left">Note.no </p>
																					</label>
																					<div class="col-sm-10">
																						<input type="Text" name="nota" class="form-control" id="inputEmail3" placeholder="-" value="<?= $hh1->nota ?>">
																					</div>
																				</div>



																				<div class="form-group">
																					<label for="inputEmail3" class="col-sm-2 control-label">
																						<p class="text-left">Harga</p>
																					</label>
																					<div class="col-sm-5 ">
																						<div class="input-group">
																							<span class="input-group-addon">Rp : </span>
																							<input type="number" min="0" name="harga" class="form-control" id="inputEmail3" placeholder="-" value="<?= $hh1->harga ?>">
																						</div>
																					</div>
																				</div>


																				</p>
																			</li>
																			<!--<li  class="list-group-item">
              <p class="list-group-item-text">
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label"><p class="text-left">Keterangan</p></label>
    <div class="col-sm-10">
      <textarea class="form-control" name="pesan" rows="3"></textarea>
    </div>
  </div>
  
  
              </p>
            </li>-->
																			<li class="list-group-item">
																				<h3>Jenis </h3>
																			</li>
																			<li class="list-group-item">
																				<p class="list-group-item-text">

																				<div class="form-group">
																					<div class="col-sm-2">
																						<div class="input-group">
																							<label>
																								<input type="radio" name="tp" value="1" class="btn btn-sm" <?php if ($hh1->jenis == 1) {
																																								echo 'checked';
																																							} ?>> Dapur
																							</label>
																						</div>
																					</div>
																					<div class="col-sm-2">
																						<div class="input-group">
																							<label>
																								<input type="radio" name="tp" value="2" class="btn btn-sm" <?php if ($hh1->jenis == 2) {
																																								echo 'checked';
																																							} ?>> Snack
																							</label>
																						</div>
																					</div>
																					<div class="col-sm-3">
																						<div class="input-group">
																							<label>
																								<input type="radio" name="tp" value="3" class="btn btn-sm" <?php if ($hh1->jenis == 3) {
																																								echo 'checked';
																																							} ?>> Lain-lain
																							</label>
																						</div>
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
										<?php } else { ?>
										<?php } ?>
									</tr>
								<?php	} ?>


							</table>
						</div>
					</div>

				</div>

			<?php } ?>

		</div>
	</div>
	<!-- Modall food dl -->
	<div class="modal fade" id="myModal" tabindex="-1">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title" id="myModalLabel">PESANAN</h4>
				</div>
				<div class="modal-body">
					<?php
					//================================ok=========================================================SIM 10417
					if ($sm == 'ya') {
					?>
						<form class="form-horizontal" method="post" action="<?= base_url() ?>/C_resepsionis_sim/simpan_tagihan_sim/<?= $id_p ?>/<?= $sm ?>">
						<?php } else { ?>
							<form class="form-horizontal" method="post" action="<?= base_url() ?>/C_resepsionis/simpan_tagihan/<?= $id_p ?>">
							<?php	}
						//=========================================================================================SIM 10417

							?>

							<ul class="list-group">
								<li class="list-group-item">
									<p class="list-group-item-text">


									<div class="form-group">
										<label for="inputEmail3" class="col-sm-2 control-label">
											<p class="text-left">Note.no </p>
										</label>
										<div class="col-sm-10">
											<input type="Text" name="nota" class="form-control" placeholder="-" id="inputEmail3" required>
										</div>
									</div>


									<div class="form-group">
										<label for="inputEmail3" class="col-sm-2 control-label">
											<p class="text-left">Harga</p>
										</label>
										<div class="col-sm-5 ">
											<div class="input-group">
												<span class="input-group-addon">Rp : </span>
												<input type="number" min="0" name="harga" class="form-control" placeholder="-" id="inputEmail3" required>
											</div>
										</div>
									</div>

									<div class="form-group">
										<label for="inputEmail3" class="col-sm-2 control-label">
											<p class="text-left">Tanggal </p>
										</label>
										<div class="col-sm-5">
											<input type="text" name="tanggal" id="datetimepicker11" placeholder="<?= date('d-m-Y') ?>" value="<?= date('d-m-Y') ?>" class="form-control date" required>
										</div>
									</div>


									</p>
								</li>

								<li class="list-group-item">
									<h3>Jenis </h3>
								</li>
								<li class="list-group-item">
									<p class="list-group-item-text">

									<div class="form-group">
										<div class="col-sm-2">
											<div class="input-group">
												<label>
													<input type="radio" name="tp" value="1" class="btn btn-sm" checked> Dapur
												</label>
											</div>
										</div>
										<div class="col-sm-2">
											<div class="input-group">
												<label>
													<input type="radio" name="tp" value="2" class="btn btn-sm"> Snack
												</label>
											</div>
										</div>
										<div class="col-sm-3">
											<div class="input-group">
												<label>
													<input type="radio" name="tp" value="3" class="btn btn-sm"> Lain-lain
												</label>
											</div>
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
	<!--MODAL TAMBAH DATA LAIN ROOM ok-->
	<div class="modal fade" id="myModalroom" tabindex="-1">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title" id="myModalLabel">Tambah Kamar</h4>
				</div>
				<div class="modal-body">

					<ul class="list-group">
						<?php
						//================================ok=========================================================SIM 10417
						if ($sm == 'ya') {
						?>
							<form class="form-horizontal" method="post" action="<?= base_url() ?>/C_resepsionis_sim/up_kamar_sim/<?= $id_p ?>/<?= $sm ?>">
							<?php } else { ?>
								<form class="form-horizontal" method="post" action="<?= base_url() ?>/C_resepsionis/up_kamar/<?= $id_p ?>">
								<?php	}
							//=========================================================================================SIM 10417

								?>

								<li class="list-group-item">
									<h3>Pilih Jenis Kamar</h3>
								</li>
								<li class="list-group-item">
									<p class="list-group-item-text">


									<div class="form-group">
										<div class="col-sm-12">
											<?php
											$g_jkam = $this->Mhotel->getjenis_kamar();

											foreach ($g_jkam->result() as $gj) {
											?>
												<div class="col-sm-2">
													<p class="text-left"><b><?= $gj->jenis_kamar ?></b></p>
													<hr />
													<?php
													if ($sm == 'ya') {
														$dd = $this->Mhotel->cek_kamar_no_dd_all($gj->id_jkamar);
													} else {
														$dd = $this->Mhotel->cek_kamar_no_dd($gj->id_jkamar);
													}

													if ($dd->num_rows() > 0) {
														foreach ($dd->result() as $dd1) { ?>
															<input class="btn btn-xs" type="checkbox" name="k_<?= $dd1->id_kamar ?>" value="<?= $dd1->id_kamar ?>" /> No. <?= $dd1->id_kamar ?><br />
														<?php } ?>
													<?php	} else { ?>
														<p class="text-danger"">Kamar Penuh</p>
<?php } ?>
 <br/>
    </div>
   <?php

											}
	?>
   
    
    
     <?php

		//  echo form_dropdown('kamar',$kamar,'','class="form-control" ')
		?> 
    </div>
  </div>
<hr/>
  <div class=" form-group">
															<label for="inputEmail3" class="col-sm-2 control-label">
																<p class="text-left">Date</p>
															</label>
														<div class="col-sm-10">
															<?php

															echo form_dropdown('tgl', $tgl, '', 'class="form-control" ')
															?>
														</div>
												</div>
												<!---->
												<hr />




												<div class="form-group">

													<div class="col-sm-12" align="right">
														<button type="submit" class="btn btn-success btn-md ">Simpan</button>
													</div>
												</div>

												</p>
								</li>
								</form>

					</ul>





				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
				</div>
			</div>
		</div>
	</div>
	<!--PERPANJANG ok-->
	<div class="modal fade" id="myModalperpanjang" tabindex="-1">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title" id="myModalLabel">Perpanjang Kamar</h4>
				</div>
				<div class="modal-body">

					<ul class="list-group">
						<?php
						//================================ok=========================================================SIM 10417
						if ($sm == 'ya') {
						?>
							<form class="form-horizontal" method="post" action="<?= base_url() ?>/C_resepsionis_sim/perpanjang_kamar_sim/<?= $id_p ?>/<?= $sm ?>">
							<?php } else { ?>
								<form class="form-horizontal" method="post" action="<?= base_url() ?>/C_resepsionis/perpanjang_kamar/<?= $id_p ?>">
								<?php	}
							//=========================================================================================SIM 10417

								?>
								<li class="list-group-item">
									<h3>Pilih No Kamar</h3>
								</li>
								<li class="list-group-item">
									<p class="list-group-item-text">


									<div class="form-group">
										<div class="col-sm-12">

											<div class="col-sm-6">
												<p class="text-left"><b></b></p>
												<?php
												//================================ok=========================================================SIM 10417
												if ($sm == 'ya') {
													$dd = $this->Mhotel->cek_kamar_no_dd_id_sim($id_p);
												} else {
													$dd = $this->Mhotel->cek_kamar_no_dd_id($id_p);
												}
												//=========================================================================================SIM 10417


												foreach ($dd->result() as $dd1) {
													if ($sm == 'ya') {
												?>

														<input class="btn btn-xs" type="checkbox" name="k_<?= $dd1->id_k ?>" value="<?= $dd1->id_k ?>" checked />No. <?= $dd1->id_k ?>

														<br />

													<?php } else { ?>

														<input class="btn btn-xs" type="checkbox" name="k_<?= $dd1->id_kamar ?>" value="<?= $dd1->id_kamar ?>" checked /> <?= $dd1->jenis_kamar ?> No. <?= $dd1->id_kamar ?><br />
												<?php
													}
												} ?>
											</div>
											<?php

											//  echo form_dropdown('kamar',$kamar,'','class="form-control" ')
											?>
										</div>
									</div>
									<hr />
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-2 control-label">
											<p class="text-left">Perpanjang</p>
										</label>
										<div class="col-sm-10">
											<div class="input-group">
												<input type="number" min="0" name="hari" value="1" class="form-control">
												<span class="input-group-addon">hari</span>
											</div>
										</div>
									</div>




									<hr />
									<div class="form-group">

										<div class="col-sm-12" align="right">
											<button type="submit" class="btn btn-success btn-md ">Simpan</button>
										</div>
									</div>

									</p>
								</li>
								</form>

					</ul>





				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
				</div>
			</div>
		</div>
	</div>

	<?php
	//echo $this->Mhotel->get_max_nota();
	?>
</div><!-- /.container -->
<?php

//ECHO $this->Mhotel->get_max_nota_n();///get mak nota ////rev feb 17
//	ECHO	$this->Mhotel->get_max_nota();////C ??K

//echo $this->session->userdata('id_tgl');
//echo $this->session->userdata('sip');
?>