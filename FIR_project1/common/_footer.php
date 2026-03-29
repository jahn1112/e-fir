<footer class="footer">
    <div class="footer-content">
        <div class="footer-links">
            <h4 style="margin-bottom: 1.5rem; color: var(--accent-blue);">Quick Links</h4>
            <a href="PDF/T_And_C.pdf" target="_blank" class="term"><i class="fas fa-chevron-right" style="font-size: 0.8rem; margin-right: 8px;"></i> Terms & Conditions</a>
            <a href="PDF/F_And_Q.pdf" target="_blank" class="faq"><i class="fas fa-chevron-right" style="font-size: 0.8rem; margin-right: 8px;"></i> FAQ</a>
            <a href="PDF/P_And_p.pdf" target="_blank" class="pp"><i class="fas fa-chevron-right" style="font-size: 0.8rem; margin-right: 8px;"></i> Privacy Policy</a>
            <a href="feedback.php" target="" class="feed"><i class="fas fa-chevron-right" style="font-size: 0.8rem; margin-right: 8px;"></i> Feedback</a>
        </div>

        <div class="footer-info">
            <h4 style="margin-bottom: 1.5rem; color: var(--accent-blue);">Emergency Contacts</h4>
            <p style="margin-bottom: 0.5rem;"><i class="fas fa-phone-alt" style="margin-right: 10px;"></i> Police Helpline: 100 / 112</p>
            <p style="margin-bottom: 0.5rem;"><i class="fas fa-venus" style="margin-right: 10px;"></i> Women Helpline: 1091 / 181</p>
            <p><i class="fas fa-child" style="margin-right: 10px;"></i> Child Helpline: 1098</p>
        </div>

        <div class="footer-social">
            <h4 style="margin-bottom: 1.5rem; color: var(--accent-blue);">Follow Gujarat Police</h4>
            <div class="icons">
                <a href="https://www.facebook.com/dgpgujaratofficial/" target="_blank" title="Facebook"><i class="fab fa-facebook-f"></i></a>
                <a href="https://www.instagram.com/gujaratpolice_/" target="_blank" title="Instagram"><i class="fab fa-instagram"></i></a>
                <a href="https://twitter.com/GujaratPolice" target="_blank" title="Twitter"><i class="fab fa-twitter"></i></a>
            </div>
        </div>
    </div>
    <div style="text-align: center; font-size: 0.9rem; opacity: 0.7; padding-top: 2rem; border-top: 1px solid var(--glass-border); margin-top: 2rem;">
        &copy; <?php echo date("Y"); ?> Gujarat Police Department. All Rights Reserved.
    </div>
</footer>

<style>
/* Consolidated Footer Styles */
.footer {
    background: rgba(15, 23, 42, 0.9);
    backdrop-filter: blur(12px);
    border-top: 1px solid var(--glass-border);
    padding: 4rem 5%;
    color: var(--text-white);
    margin-top: 4rem;
}

.footer-content {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 3rem;
    max-width: 1200px;
    margin: 0 auto;
}

.footer-links {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.footer-links a {
    color: var(--text-muted);
    text-decoration: none;
    font-size: 0.9rem;
    transition: var(--transition);
}

.footer-links a:hover {
    color: var(--accent-blue);
    transform: translateX(5px);
}

.footer-info p {
    color: var(--text-muted);
    font-size: 0.9rem;
}

.footer-social .icons {
    display: flex;
    gap: 1.5rem;
}

.footer-social .icons a {
    background: rgba(255, 255, 255, 0.05);
    width: 45px;
    height: 45px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--text-white);
    font-size: 1.2rem;
    transition: var(--transition);
    border: 1px solid var(--glass-border);
}

.footer-social .icons a:hover {
    background: var(--accent-blue);
    transform: translateY(-5px);
    box-shadow: 0 5px 15px var(--accent-glow);
}
</style>
