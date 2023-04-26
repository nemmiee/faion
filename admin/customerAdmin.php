<div class="content">
    <div class="table-container">
        <table class="table" cellspacing="0">
            <thead>
                <tr>
                    <th class="name">Tên khách hàng</th>
                    <th class="email">Email</th>
                    <th class="address">Địa chỉ</th>
                    <th class="phoneNum">Số điện thoại</th>
                    <th class="createdAt">Ngày tạo</th>     
                </tr>
            </thead>
            <tbody id="customer-info">
                <?php displayCustomerTable() ?>
            </tbody>
        </table>
    </div>
</div>


<?php
function displayCustomerTable()
{
    $db = new Database();    
    $customerList = getCustomerList();    
    for ($i = 0; $i < count($customerList); $i++) {
        echo "
        <tr>            
            <td class=\"name\"><a href=\"/faion/index.php/admin/customers?id=" . $customerList[$i]->getId() . "\">" . $customerList[$i]->getName() . "</a></td>
            <td class=\"email\">" . $customerList[$i]->getEmail() . "</td>
            <td class=\"address\">" . $customerList[$i]->getAddress() . "</td>
            <td class=\"phoneNum\">" . $customerList[$i]->getPhoneNum() . "</td>
            <td class=\"createdAt\">" . getDMYdate($customerList[$i]->getCreatedAt()) . "</td>
        </tr>";
    }
    $db->disconnect();
}
?>