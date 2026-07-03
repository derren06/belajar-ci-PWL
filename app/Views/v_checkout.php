<?= $this->extend('layout') ?>
<?= $this->section('content') ?>
<div class="row">

    <!-- FORM -->
    <div class="col-lg-5">

        <div class="card shadow-sm">
            <div class="card-header">
                <h5>Detail Pesanan</h5>
            </div>

            <div class="card-body">

                <?= form_open('buy') ?>

                <?= form_hidden('username', session()->get('username')) ?>

                <div class="mb-3">
                    <label>Nama</label>
                    <input class="form-control"
                        value="<?= session()->get('username') ?>"
                        readonly>
                </div>

                <div class="mb-3">
                    <label>Alamat</label>
                    <input
                        type="text"
                        name="alamat"
                        class="form-control">
                </div>

                <div class="mb-3">
                    <label>Kelurahan</label>
                    <?= form_dropdown('kelurahan', [], '', [
                        'id' => 'kelurahan',
                        'class' => 'form-control'
                    ]) ?>
                </div>

                <div class="mb-3">
                    <label>Layanan</label>
                    <?= form_dropdown('layanan', [], '', [
                        'id' => 'layanan',
                        'class' => 'form-control'
                    ]) ?>
                </div>

                <div class="mb-3">
                    <label>Ongkir</label>
                    <input
                        readonly
                        id="ongkir"
                        name="ongkir"
                        class="form-control">
                </div>

                <div class="mb-3">
                    <label>Kode Kupon</label>

                    <input
                        id="kupon_code"
                        name="kupon_code"
                        class="form-control"
                        placeholder="HEMAT10">

                    <small class="text-muted">
                        Tersedia : HEMAT10, HEMAT20
                    </small>
                </div>

                <button class="btn btn-primary w-100">
                    Buat Pesanan
                </button>

                <?= form_close() ?>

            </div>

        </div>

    </div>


    <!-- RINGKASAN -->
    <div class="col-lg-7">

        <div class="card shadow-sm">

            <div class="card-header">
                <h5>Ringkasan Pesanan</h5>
            </div>

            <div class="card-body">

                <table class="table">

                    <thead>

                        <tr>
                            <th>Nama</th>
                            <th>Harga</th>
                            <th>Qty</th>
                            <th>Subtotal</th>
                        </tr>

                    </thead>

                    <tbody>

                        <?php foreach ($items as $item): ?>

                            <tr>

                                <td><?= $item['name'] ?></td>

                                <td>
                                    <?= number_to_currency($item['price'], 'IDR') ?>
                                </td>

                                <td><?= $item['qty'] ?></td>

                                <td>
                                    <?= number_to_currency($item['price'] * $item['qty'], 'IDR') ?>
                                </td>

                            </tr>

                        <?php endforeach; ?>

                        <tr>
                            <td colspan="3" align="right">Subtotal</td>
                            <td><?= number_to_currency($subtotal, 'IDR') ?></td>
                        </tr>

                        <tr>
                            <td colspan="3" align="right" class="text-danger">
                                Diskon Kupon
                            </td>

                            <td class="text-danger">
                                <span id="diskonText">
                                    <?= number_to_currency($diskon_kupon, 'IDR') ?>
                                </span>
                            </td>

                        </tr>

                        <tr>
                            <td colspan="3" align="right">
                                PPN (11%)
                            </td>

                            <td>
                                <?= number_to_currency($ppn, 'IDR') ?>
                            </td>

                        </tr>

                        <tr>
                            <td colspan="3" align="right">
                                Biaya Admin
                            </td>

                            <td>
                                <?= number_to_currency($biaya_admin, 'IDR') ?>
                            </td>

                        </tr>

                        <tr>

                            <td colspan="3" align="right">
                                Ongkir
                            </td>

                            <td>
                                <span id="ongkirText">
                                    Rp 0
                                </span>
                            </td>

                        </tr>

                        <tr class="table-success">

                            <td colspan="3">
                                <strong>Grand Total</strong>
                            </td>

                            <td>

                                <strong id="total">
                                    <?= number_to_currency($total, 'IDR') ?>
                                </strong>

                            </td>

                        </tr>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>
<?= $this->endSection() ?>
<?= $this->section('script') ?>
<script>
    $(document).ready(function() {

        let subtotal = <?= $subtotal ?>;
        let ppn = <?= $ppn ?>;
        let biaya_admin = <?= $biaya_admin ?>;
        let diskon = <?= $diskon_kupon ?>;
        $("#kupon_code").on("keyup", function() {

            let kode = $(this).val().toUpperCase();

            if (kode == "HEMAT10") {
                diskon = subtotal * 0.10;
            } else if (kode == "HEMAT20") {
                diskon = subtotal * 0.20;
            } else {
                diskon = 0;
            }

            $("#diskonText").text(
                "Rp " + diskon.toLocaleString('id-ID')
            );

            hitungTotal();

        });
        let ongkir = 0;

        hitungTotal();

        function hitungTotal() {

            let total =
                subtotal +
                ppn +
                biaya_admin +
                ongkir -
                diskon;

            $("#ongkir").val(ongkir);

            $("#ongkirText").text(
                "Rp " + ongkir.toLocaleString('id-ID')
            );

            $("#diskonText").text(
                "Rp " + diskon.toLocaleString('id-ID')
            );

            $("#total").text(
                "Rp " + total.toLocaleString('id-ID')
            );

            $("#total_harga").val(total);
        }
        $('#kelurahan').select2({
            placeholder: 'Cari daerah tujuan',
            minimumInputLength: 3,
            ajax: {
                url: '<?= site_url('ajax/destinations') ?>',
                dataType: 'json',
                delay: 300,
                data: function(params) {
                    return {
                        q: params.term
                    };
                },
                processResults: function(data) {
                    return data;
                },
                cache: true


            }
        });

        $("#kelurahan").on('change', function() {
            let id_kelurahan = $(this).val();

            $("#layanan").empty();
            ongkir = 0;
            hitungTotal();

            $.ajax({
                url: "<?= site_url('ajax/costs') ?>",
                dataType: "json",
                data: {
                    destination: id_kelurahan
                },
                success: function(data) {
                    data.forEach(function(item) {
                        $("#layanan").append(
                            $('<option>', {
                                value: item.cost,
                                text: `${item.description} (${item.service}) : estimasi ${item.etd}`
                            })
                        );
                    });
                }
            });
        });

        $("#layanan").on('change', function() {
            ongkir = parseInt($(this).val());
            hitungTotal();
        });


    });
</script>
<?= $this->endSection() ?>