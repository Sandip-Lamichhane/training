</div>

<script>
    function toggleSidebar() {
        document.getElementById('sidebar').classList.toggle('-translate-x-full');
        document.getElementById('backdrop').classList.toggle('hidden');
    }

    function toggleProfileMenu(e) {
        e.stopPropagation();
        document.getElementById('profileMenu').classList.toggle('hidden');
        document.getElementById('profileChevron').classList.toggle('rotate-180');
    }

    document.addEventListener('click', function(e) {
        const menu = document.getElementById('profileMenu');
        const wrap = document.getElementById('profileMenuWrap');
        if (!menu.classList.contains('hidden') && !wrap.contains(e.target)) {
            menu.classList.add('hidden');
            document.getElementById('profileChevron').classList.remove('rotate-180');
        }
    });

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            document.getElementById('profileMenu').classList.add('hidden');
            document.getElementById('profileChevron').classList.remove('rotate-180');
        }
    });
</script>

</body>

</html>