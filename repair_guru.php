<?php
$file = 'c:\laragon\www\bimbel-mentari\resources\views\guru_user\layout.blade.php';
$content = file_get_contents($file);

$search = '            <a href="/guru/profil"
               class="{{ request()->is(\'guru/profil\') ? \'active\' : \'\' }}">

                <i class="fa-solid fa-user"></i>
                Profil';

$replace = '            <a href="/guru/profil"
               class="{{ request()->is(\'guru/profil\') ? \'active\' : \'\' }}">
                <i class="fa-solid fa-user"></i>
                Profil
            </a>

            <form method="POST" action="/logout" onsubmit="return confirm(\'Apakah Anda yakin ingin keluar?\')">
                @csrf
                <button class="logout" type="submit">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    Logout
                </button>
            </form>';

// Find the last </div> before </aside>
$content = preg_replace('/<a href="\/guru\/profil".*?Profil.*?<\/div>/s', $replace . "\n        </div>", $content);

file_put_contents($file, $content);
echo "Fixed";
