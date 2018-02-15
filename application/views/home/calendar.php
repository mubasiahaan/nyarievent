<div class="cal-all">
    <div class="circle-dot-2"></div>
    <div class="circle-menu-2"></div>
    <div class="cal">
        <table class="table table-bordered">
            <caption class="cal-caption">
                <a href="<?= site_url('home/index/' . ($month - 1)) ?>" class="prev">&laquo;</a>
                <a href="<?= site_url('home/index/' . ($month + 1)) ?>" class="next">&raquo;</a>
                <?= $month_name ?> <?= $year ?>
            </caption>
            <thead>
                <tr>
                    <td>Su</td>
                    <td>Mo</td>
                    <td>Tu</td>
                    <td>We</td>
                    <td>Th</td>
                    <td>Fr</td>
                    <td>Sa</td>
                </tr>
            </thead>
            <tbody class="cal-body">
                <?php
                for ($i = 0; $i < ($total_day + $day_start); $i++) {
                    if (($i % 7) == 0)
                        echo "<tr>";
                    if ($i < $day_start) {
                        echo "<td><a></a></td>";
                    } else {
                        $dt++;
                        if ($dt == $day_now) {
                            echo '<td class="cal-today"><a>' . $dt . '</a></td>';
                        } else {
                            if (isset($kalender[$dt])) {
                                ?>
                            <td class="cal-check">
                                <a tabindex="12"
                                   role="button" 
                                   data-html="true" 
                                   data-placement="bottom"
                                   data-toggle="popover" 
                                   data-trigger="focus" 
                                   data-content="
                                   <?php foreach ($kalender[$dt] as $value) { ?>
                                       <div><a href='<?= site_url('event/detail/' . $value['id']) ?>' target='_blank'><?= $value['title'] ?></a></div>
                                   <?php } ?>
                                   "><?= $dt ?>
                                </a>
                            </td>
                            <?php
                        } else {
                            echo "<td><a>$dt</a></td>";
                        }
                    }
                }
                if (($i % 7) == 6) {
                    echo "</tr>";
                }
            }
            ?>



            </tbody>
        </table>
    </div>
</div>
<script>
    $(function () {
        $("[data-toggle=popover]").popover();
    });
</script>