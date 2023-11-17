@extends('layouts.app')

@section("content")
    <div class="container mt-5">
        <div class="card p-6 mb-6">
            <div class="row">
                <div class="col-12 col-md-12" style="text-align: center">
                    <h3 class="title-start">Reglas del Pádel</h3>
                </div>
                <div class="col-12 col-md-12">
                    <p>
                        El pádel es el deporte de moda, que ha generado una emoción tremenda entre miles de personas en
                        todo el mundo. Antes de saltar a la pista, tienes que saber cómo se juega al pádel, por eso es
                        importante que conozcas las reglas del pádel, especialmente si planeas jugar partidos en un
                        futuro cercano.

                        El reglamento en el pádel es redactado por la Federación Internacional de Pádel, organización
                        que se encarga de regular las normas del pádel. Sin embargo, el reglamento, que se puede
                        encontrar en la página oficial de la Federación, es enorme. Es por eso que, a continuación, te
                        explicaremos solo las reglas principales y los consejos sobre pádel más valiosos, para que
                        puedas jugar un partido de manera reglamentaria. Además, te dejamos un par de vídeos para que
                        puedas entender el juego de manera más sencilla, con un apoyo visual.
                    </p>
                    <br>
                    <img class="img_rules" src="{{asset('img/reglas.png')}}">
                    <br>
                    <h4 style="text-align: center">Reglas del saque en el páadel</h4>
                    <p>
                        El saque es uno de los momentos más relevantes del partido porque es el que da por iniciado el
                        punto. Para sacar, el pádel cuenta con reglas muy específicas que lo diferencias con el saque
                        del tenis. En primer lugar, es crucial que el jugador se pare por detrás de la línea del saque,
                        y no puede pisarla durante el mismo porque sería contado como un punto perdido. Antes de golpear
                        la pelota para pasarla al otro lado de la pista, la pelota debe de rebotar una vez en el piso
                        para después hacer el contacto. Por último, es necesario que el contacto se realiza a la altura
                        de la cintura como máximo.

                        Al golpear la pelota en el saque, debe de cruzar al otro lado de la pista sin tocar la red. Con
                        el más mínimo roce, el saque sería considerado como fallido. Además, el saque se debe de hacer
                        en dirección contraria, es decir, en diagonal. Para que el saque sea bueno, también es necesario
                        que la pelota rebote primero delante de la línea de saque, si rebota por detrás de ella, o
                        impacta directamente en una pared, es un saque malo.
                    </p>
                    <br>
                    <h4 style="text-align: center">La pelota y la pala de pádel</h4>
                    <p>
                        Las características de la pelota y la pala de pádel también juegan un papel importante en el
                        reglamento oficial. Esto significa que deben de tener cualidades y características específicas
                        para ser aceptas de manera oficial. En el reglamento, sé específica que «La pelota deberá ser
                        una esfera de goma con una superficie exterior uniforme de color blanco o amarillo.

                        Su diámetro debe medir entre 6,35 y 6,77 cm y su peso estará entre 56,0 y 59,4 grs. Deberá tener
                        un rebote comprendido entre 135 y 145 cm al dejarla caer sobre una superficie dura desde 2,54 m.
                        La pelota deberá tener una presión interna entre 4,6 Kg y 5,2 Kg por cada 2,54 cm cuadrados.
                    </p>
                    <br>
                    <p>
                        Con respecto a la pala, el reglamento señala que «La pala se compone de dos partes: cabeza y
                        puño».
                    </p>
                    <ul>
                        <li><p>
                                Puño: largo máximo: 20 cm, ancho máximo (de cada una de las horquillas, sin considerar
                                el
                                espacio vacío entre ellas): 50 mm, grosor máximo: 50 mm.
                            </p>
                        </li>
                        <li><p>
                                Cabeza: largo: variable. El largo de la cabeza más el largo del puño no puede exceder de
                                45,5
                                cm, ancho máximo: 26 cm, grosor máximo: 38 mm. El largo del total de la pala, cabeza más
                                puño,
                                no podrá exceder de 45,5 centímetros.»
                            </p>
                        </li>
                    </ul>
                    <br>
                    <h4 style="text-align: center">El sistema de puntuación</h4>
                    <p>
                        El sistema de puntuación en el pádel es muy similar al del tenis. El primer punto bueno equivale
                        a 15 puntos, el segundo a 30, el tercero a 40 y el cuarto es el punto de juego. Esto solo cambia
                        si el marcador se empata a 40. En este caso, el cuarto punto se convierte en un punto de
                        ventaja, para poder llevarse el juego, es necesario ganar dos puntos consecutivos.

                        Los partidos de pádel se componen de sets y juegos. Generalmente, se juega al mejor de tres
                        sets, y cada uno de esos seta se compone de juegos. Para que un equipo pueda ganar un set, es
                        necesario que gane 6 juegos, manteniendo como mínimo una ventaja de dos. Si los equipos empatan
                        a 5, entonces para ganar el juego es necesario ganar 7 juegos, con un marcador de 7-5. Pero, si
                        llega a suceder un empate 6-6, entonces se tiene que jugar lo que se le conoce como desempate o
                        tie break.

                        En un tie break, ganará el equipo que obtenga 7 puntos, manteniendo una ventaja de 2 puntos. Si
                        esta ventaja de dos puntos no se consigue, entonces se seguirá alargando hasta que alguno de los
                        dos equipos obtenga esa diferencia de dos. En un tie break o desempate ya no se cuenta de a 15,
                        30, 40… sino que se cuenta de manera natural empezando con el 1, 2, 3, 4, 5, 6, 7 y así
                        sucesivamente. </p>

                    <br>
                    <h4 style="text-align: center">Los puntos buenos, malos y faltas</h4>
                    <p>
                        Hay diversas situaciones en las que se puede ganar o perder un punto. Como vimos anteriormente,
                        en el saque, la pelota tiene que cruzar al otro lado sin tocar la red, y siempre rebotando
                        primero antes de la línea de saque. Aun cuando el punto ha iniciado, la pelota siempre debe de
                        tocar primero el suelo y después rebotar en las paredes o rejas de la pista. El jugador gana el
                        punto cuando sucede lo siguiente:

                        La pelota rebote en el suelo y posteriormente se sale de la pista.
                        La pelota rebota dos veces en el suelo de la cancha del rival.
                        La pelota toca la red y cruza al lado rival de la pista (no válido en el saque).
                        Cuando los rivales mandan la pelota afuera de la pista o toca directamente una pared sin
                        anticipadamente haber rebotado en el suelo.

                        También es importante saber que los jugadores tienen prohibido tocar la red o recargarse en
                        ella. Si el jugador lo hace, será un punto perdido. En el saque, los jugadores tienen dos
                        oportunidades para realizarlo de manera correcta, si luego del segundo intento vuelven a fallar,
                        entonces es un punto perdido.</p>
                    <br>
                    <img class="img_rules" src="{{asset('img/pista_medidas.jpg')}}" alt="">

                </div>

            </div>
        </div>
    </div>
@endsection
