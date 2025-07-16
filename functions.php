function enqueue_ctrl_p_publish_script() {
    $screen = get_current_screen();

    if (is_admin() && $screen && $screen->base === 'post') {
        ?>
        <script>
        document.addEventListener('keydown', function(event) {
            if (event.ctrlKey && event.key.toLowerCase() === 'p') {
                event.preventDefault();

                // 1단계: 퍼블리시 패널 열기
                const openPublishPanel = document.querySelector('button.editor-post-publish-panel__toggle');
                if (openPublishPanel && !openPublishPanel.disabled) {
                    openPublishPanel.click();
                }

                // 2단계: 퍼블리시 버튼 클릭 시도 (반복적으로 감지)
                const tryPublish = () => {
                    const finalButton = document.querySelector('button.editor-post-publish-button');
                    if (finalButton && !finalButton.disabled && finalButton.offsetParent !== null) {
                        finalButton.click();
                    } else {
                        setTimeout(tryPublish, 150); // 버튼이 생길 때까지 반복
                    }
                };

                setTimeout(tryPublish, 300);
            }
        });
        </script>
        <?php
    }
}
add_action('admin_footer', 'enqueue_ctrl_p_publish_script');
