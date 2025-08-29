<?php
include 'header.php';
?>
<div class="row justify-content-center mt-5">
    <div class="col-md-6">
        <div class="card p-4 shadow">
            <h3 class="text-center mb-4">ເພີ່ມພະນັກງານ</h3>
            <form action="employee_add_pc.php" method="POST">
                <div class="mb-3">
                    <label class="form-label"></label>
                    <input type="hidden" name="id" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label">ຊື່</label>
                    <input type="text" name="name" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">ເບີໂທ</label>
                    <input type="number" name="phone" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">ລະຫັດຜ່ານ</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">ສະຖານະ</label>
                    <select name="is_admin" class="form-select" required>
                        <option value="1">admin</option>
                        <option value="0">user</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary w-100 btnf">ຕົກລົງ</button>
            </form>
        </div>
    </div>
</div>
</div>
</div>
</body>

</html>