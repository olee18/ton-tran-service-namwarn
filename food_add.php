<?php
include 'header.php' ?>
<div class=" mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card p-4 shadow">
                <h3 class="text-center mb-4">ເພີ່ມອາຫານ & ເຄື່ອງດື່ມ</h3>
                <form action="food_add_pc.php" method="POST">
                    <div class="mb-3">
                        <label for="id" class="form-label"></label>
                        <input type="hidden" class="form-control" id="id" name="id">
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">ຊື່ອາຫານ</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">

                        <label for="food_type" class="form-label">ປະເພດອາຫານ</label>
                        <select class="form-select" id="food_type" name="type" required>
                            <option value="">-- Select Type --</option>
                            <option value="Food">ອາຫານ</option>
                            <option value="Drink">ເຄື່ອງດື່ມ</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">ລາຄາ</label>
                        <input type="number" step="0.01" class="form-control" id="price" name="price" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 btnf">ຕົກລົງ</button>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</body>

</html>