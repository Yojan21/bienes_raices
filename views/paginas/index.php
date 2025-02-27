<main class="contenedor seccion">
        <h1>Más sobre nosotros</h1>
        <?php include 'iconos.php' ?>
    </main>

    <section class="seccion contenedor">
        <h2>Casas y Aptos en venta</h2>
        <?php 
            $limite = 3;
            include 'listado.php' 
        ?>

        <div class="ver_todas alinear_derecha">
            <a href="/propiedades" class="boton_verde">Ver Todas</a>
        </div>
    </section>

    <section class="imagen_contacto">
        <h2>Encuentra la casa de tus sueños</h2>
        <p>Llena el formulario de contacto y un asesor se pondra en contacto contigo a la brevedad</p>
        <a href="/contacto" class="boton_amarillo">Contactanos</a>
    </section>

    <div class="contenedor seccion seccion_inferior">
        <section class="blog">
            <h3>Nuestro Blog</h3>
            <article class="entrada_blog">
                <div class="imagen">
                    <picture>
                        <source srcset="build/img/blog1.webp" type="image/webp">
                        <source srcset="build/img/blog1.jpg" type="image/jpeg">
                        <img loading="lazy" src="build/img/blog1.jpg" alt="Texto Entrada de Blog">
                    </picture>
                </div>

                <div class="texto_entrada">
                    <a href="entrada.php">
                        <h4>Terraza en el techo de tu casa</h4>
                        <p>Escrito el:<span>04/02/25</span> por: <span>Admin</span></p>
                        <p>Consejos para construir una terraza en el techo de tu casa con los mejores materiales y ahorrando dinero</p>
                    </a>
                </div>

            </article>


            <article class="entrada_blog">
                <div class="imagen">
                    <picture>
                        <source srcset="build/img/blog2.webp" type="image/webp">
                        <source srcset="build/img/blog2.jpg" type="image/jpeg">
                        <img loading="lazy" src="build/img/blog2.jpg" alt="Texto Entrada de Blog">
                    </picture>
                </div>

                <div class="texto_entrada">
                    <a href="entrada.php">
                        <h4>Guia para la decoracion de tu hogar</h4>
                        <p>Escrito el:<span>04/02/25</span> por: <span>Admin</span></p>
                        <p>Maximiza el espacio en tu hogar con esta guia, aprende a combinar muebles y colores para darle vida a tu espacio</p>
                    </a>
                </div>

            </article>
        </section>
        <section class="testimoniales">
            <h3>Testimoniales</h3>
            <div class="testimonial">
                <blockquote>
                    El personal se comportó de una excelente forma, muy buena atención y la casa que me ofrecieron cumple con todas mis expectativas
                </blockquote>
                <p>-Yojan Romero </p>
            </div>
        </section>
    </div>