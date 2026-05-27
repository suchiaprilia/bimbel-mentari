<?php
$file = 'c:\laragon\www\bimbel-mentari\resources\views\siswa_user\layout.blade.php';
$content = file_get_contents($file);

$search = '<form method="POST" action="/logout">
                @csrf
                <button class="logout" type="submit">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    Logout
                </button>
            </form>';

// Try different whitespace versions if needed, but let's just use preg_replace
$replace = '<form method="POST" action="/logout" onsubmit="return confirm(\'Apakah Anda yakin ingin keluar?\')">
                @csrf
                <button class="logout" type="submit">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    Logout
                </button>
            </form>';

if (strpos($content, '<form method="POST" action="/logout">') !== false) {
    $content = str_replace('<form method="POST" action="/logout">', '<form method="POST" action="/logout" onsubmit="return confirm(\'Apakah Anda yakin ingin keluar?\')">', $content);
} else {
    // If it was already messed up and became empty
    $content = preg_replace('/<div style="margin-top: 20px;">.*?<\/div>.*?<\/aside>/s', '<div style="margin-top: 20px;">...</div>' . $replace . "\n        </div>\n\n    </aside>", $content);
    // Actually let's just append it before </div> </aside>
}

file_put_contents($file, $content);
echo "Fixed Siswa";
