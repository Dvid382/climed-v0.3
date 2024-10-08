toc.dat                                                                                             0000600 0004000 0002000 00000165420 14677744762 0014477 0                                                                                                    ustar 00postgres                        postgres                        0000000 0000000                                                                                                                                                                        PGDMP       /    8            	    |            climed    12.18    12.18 �    $           0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                      false         %           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                      false         &           0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                      false         '           1262    34046    climed    DATABASE     �   CREATE DATABASE climed WITH TEMPLATE = template0 ENCODING = 'UTF8' LC_COLLATE = 'Spanish_Venezuela.1252' LC_CTYPE = 'Spanish_Venezuela.1252';
    DROP DATABASE climed;
                postgres    false         �            1255    34047 K   calcular_diferencia_minutos(time without time zone, time without time zone)    FUNCTION     �   CREATE FUNCTION public.calcular_diferencia_minutos(hora1 time without time zone, hora2 time without time zone) RETURNS integer
    LANGUAGE plpgsql
    AS $$
BEGIN
    RETURN EXTRACT(EPOCH FROM (hora2 - hora1)) / 60;
END;
$$;
 n   DROP FUNCTION public.calcular_diferencia_minutos(hora1 time without time zone, hora2 time without time zone);
       public          postgres    false         �            1259    34048    asignaciones    TABLE     2  CREATE TABLE public.asignaciones (
    id integer NOT NULL,
    nombre character varying(100) NOT NULL,
    estatus integer NOT NULL,
    descripcion character varying(100) NOT NULL,
    f_inicio date NOT NULL,
    f_fin date NOT NULL,
    fk_usuario integer NOT NULL,
    fk_servicios integer NOT NULL
);
     DROP TABLE public.asignaciones;
       public         heap    postgres    false         �            1259    34051    asignaciones_id_seq    SEQUENCE     �   CREATE SEQUENCE public.asignaciones_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 *   DROP SEQUENCE public.asignaciones_id_seq;
       public          postgres    false    202         (           0    0    asignaciones_id_seq    SEQUENCE OWNED BY     K   ALTER SEQUENCE public.asignaciones_id_seq OWNED BY public.asignaciones.id;
          public          postgres    false    203         �            1259    34053    cargos    TABLE       CREATE TABLE public.cargos (
    id integer NOT NULL,
    nombre character varying(80) NOT NULL,
    descripcion character varying(100),
    estatus smallint DEFAULT 1,
    fk_servicio integer,
    CONSTRAINT cargo_estatus_check CHECK ((estatus = ANY (ARRAY[0, 1])))
);
    DROP TABLE public.cargos;
       public         heap    postgres    false         �            1259    34058    cargo_id_seq    SEQUENCE     �   CREATE SEQUENCE public.cargo_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 #   DROP SEQUENCE public.cargo_id_seq;
       public          postgres    false    204         )           0    0    cargo_id_seq    SEQUENCE OWNED BY     >   ALTER SEQUENCE public.cargo_id_seq OWNED BY public.cargos.id;
          public          postgres    false    205         �            1259    34060    citas    TABLE     @  CREATE TABLE public.citas (
    id integer NOT NULL,
    fk_persona integer NOT NULL,
    fk_servicio integer NOT NULL,
    fk_usuario integer NOT NULL,
    fecha date NOT NULL,
    hora time without time zone NOT NULL,
    estatus integer NOT NULL,
    fk_usuario_sesion integer NOT NULL,
    fk_consultorio integer
);
    DROP TABLE public.citas;
       public         heap    postgres    false         �            1259    34063    citas_enfermeria    TABLE     �   CREATE TABLE public.citas_enfermeria (
    id integer NOT NULL,
    altura character varying(80) NOT NULL,
    peso character varying(80) NOT NULL,
    tension character varying(80) NOT NULL,
    fk_cita integer
);
 $   DROP TABLE public.citas_enfermeria;
       public         heap    postgres    false         �            1259    34066    citas_enfermeria_id_seq    SEQUENCE     �   CREATE SEQUENCE public.citas_enfermeria_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 .   DROP SEQUENCE public.citas_enfermeria_id_seq;
       public          postgres    false    207         *           0    0    citas_enfermeria_id_seq    SEQUENCE OWNED BY     S   ALTER SEQUENCE public.citas_enfermeria_id_seq OWNED BY public.citas_enfermeria.id;
          public          postgres    false    208         �            1259    34068    citas_id_seq    SEQUENCE     �   CREATE SEQUENCE public.citas_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 #   DROP SEQUENCE public.citas_id_seq;
       public          postgres    false    206         +           0    0    citas_id_seq    SEQUENCE OWNED BY     =   ALTER SEQUENCE public.citas_id_seq OWNED BY public.citas.id;
          public          postgres    false    209         �            1259    34070    componentesactivos    TABLE     �   CREATE TABLE public.componentesactivos (
    id integer NOT NULL,
    nombre character varying(140),
    descripcion character varying(140)
);
 &   DROP TABLE public.componentesactivos;
       public         heap    postgres    false         �            1259    34073    componentesactivos_id_seq    SEQUENCE     �   CREATE SEQUENCE public.componentesactivos_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 0   DROP SEQUENCE public.componentesactivos_id_seq;
       public          postgres    false    210         ,           0    0    componentesactivos_id_seq    SEQUENCE OWNED BY     W   ALTER SEQUENCE public.componentesactivos_id_seq OWNED BY public.componentesactivos.id;
          public          postgres    false    211         �            1259    34075    consultorios    TABLE     �   CREATE TABLE public.consultorios (
    id integer NOT NULL,
    nombre character varying(100),
    descripcion character varying(100),
    estatus smallint
);
     DROP TABLE public.consultorios;
       public         heap    postgres    false         �            1259    34078    consultorios_id_seq    SEQUENCE     �   CREATE SEQUENCE public.consultorios_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 *   DROP SEQUENCE public.consultorios_id_seq;
       public          postgres    false    212         -           0    0    consultorios_id_seq    SEQUENCE OWNED BY     K   ALTER SEQUENCE public.consultorios_id_seq OWNED BY public.consultorios.id;
          public          postgres    false    213         �            1259    34080    historias_medicas    TABLE     �   CREATE TABLE public.historias_medicas (
    id integer NOT NULL,
    diagnostico character varying(400) NOT NULL,
    fk_patologia integer,
    fk_laboratorio integer,
    fk_cita_enfermeria integer
);
 %   DROP TABLE public.historias_medicas;
       public         heap    postgres    false         �            1259    34083    historias_medicas_id_seq    SEQUENCE     �   CREATE SEQUENCE public.historias_medicas_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 /   DROP SEQUENCE public.historias_medicas_id_seq;
       public          postgres    false    214         .           0    0    historias_medicas_id_seq    SEQUENCE OWNED BY     U   ALTER SEQUENCE public.historias_medicas_id_seq OWNED BY public.historias_medicas.id;
          public          postgres    false    215         �            1259    34085    laboratorios    TABLE     �   CREATE TABLE public.laboratorios (
    id integer NOT NULL,
    nombre character varying(100),
    estatus integer,
    valor integer,
    descripcion character varying(100)
);
     DROP TABLE public.laboratorios;
       public         heap    postgres    false         �            1259    34088    laboratorios_id_seq    SEQUENCE     �   CREATE SEQUENCE public.laboratorios_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 *   DROP SEQUENCE public.laboratorios_id_seq;
       public          postgres    false    216         /           0    0    laboratorios_id_seq    SEQUENCE OWNED BY     K   ALTER SEQUENCE public.laboratorios_id_seq OWNED BY public.laboratorios.id;
          public          postgres    false    217         �            1259    34090    medicamentos    TABLE     j  CREATE TABLE public.medicamentos (
    id integer NOT NULL,
    nombre_comercial character varying(400) NOT NULL,
    descripcion character varying(400) NOT NULL,
    cantidad character varying(400) NOT NULL,
    fk_componentesactivos integer,
    fk_tipo_medicamento integer NOT NULL,
    fk_unidadmedida integer NOT NULL,
    fk_unidadpeso integer NOT NULL
);
     DROP TABLE public.medicamentos;
       public         heap    postgres    false         �            1259    34096    medicamentos_id_seq    SEQUENCE     �   CREATE SEQUENCE public.medicamentos_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 *   DROP SEQUENCE public.medicamentos_id_seq;
       public          postgres    false    218         0           0    0    medicamentos_id_seq    SEQUENCE OWNED BY     K   ALTER SEQUENCE public.medicamentos_id_seq OWNED BY public.medicamentos.id;
          public          postgres    false    219         �            1259    34098    menus    TABLE     �   CREATE TABLE public.menus (
    id integer NOT NULL,
    nombre character varying(100),
    url character varying(100),
    icono character varying(100),
    orden integer
);
    DROP TABLE public.menus;
       public         heap    postgres    false         �            1259    34101    menu_id_seq    SEQUENCE     �   CREATE SEQUENCE public.menu_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 "   DROP SEQUENCE public.menu_id_seq;
       public          postgres    false    220         1           0    0    menu_id_seq    SEQUENCE OWNED BY     <   ALTER SEQUENCE public.menu_id_seq OWNED BY public.menus.id;
          public          postgres    false    221         �            1259    34103    menu_usuario    TABLE     �   CREATE TABLE public.menu_usuario (
    id integer NOT NULL,
    fk_usuario integer NOT NULL,
    fk_menu integer NOT NULL,
    fk_submenu integer NOT NULL
);
     DROP TABLE public.menu_usuario;
       public         heap    postgres    false         �            1259    34106    menu_usuario_id_seq    SEQUENCE     �   CREATE SEQUENCE public.menu_usuario_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 *   DROP SEQUENCE public.menu_usuario_id_seq;
       public          postgres    false    222         2           0    0    menu_usuario_id_seq    SEQUENCE OWNED BY     K   ALTER SEQUENCE public.menu_usuario_id_seq OWNED BY public.menu_usuario.id;
          public          postgres    false    223         �            1259    34108 
   patologias    TABLE     �   CREATE TABLE public.patologias (
    id integer NOT NULL,
    nombre character varying(100) NOT NULL,
    estatus integer NOT NULL,
    valor integer NOT NULL,
    descripcion character varying(800) NOT NULL,
    alerta integer NOT NULL
);
    DROP TABLE public.patologias;
       public         heap    postgres    false         �            1259    34111    patologias_id_seq    SEQUENCE     �   CREATE SEQUENCE public.patologias_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 (   DROP SEQUENCE public.patologias_id_seq;
       public          postgres    false    224         3           0    0    patologias_id_seq    SEQUENCE OWNED BY     G   ALTER SEQUENCE public.patologias_id_seq OWNED BY public.patologias.id;
          public          postgres    false    225         �            1259    34113    personas    TABLE     n  CREATE TABLE public.personas (
    id integer NOT NULL,
    nombre character varying(100) NOT NULL,
    apellido character varying(100) NOT NULL,
    cedula character varying(9) NOT NULL,
    telefono character varying(12) NOT NULL,
    correo character varying(100) NOT NULL,
    sexo integer NOT NULL,
    direccion character varying(100) NOT NULL,
    f_nacimiento date NOT NULL,
    estatus character varying(20),
    segundo_nombre character varying(80) DEFAULT 'Sin segundo nombre'::character varying NOT NULL,
    segundo_apellido character varying(80) DEFAULT 'Sin segundo apellido'::character varying NOT NULL
);
    DROP TABLE public.personas;
       public         heap    postgres    false         �            1259    34121    personas_id_seq    SEQUENCE     �   CREATE SEQUENCE public.personas_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 &   DROP SEQUENCE public.personas_id_seq;
       public          postgres    false    226         4           0    0    personas_id_seq    SEQUENCE OWNED BY     C   ALTER SEQUENCE public.personas_id_seq OWNED BY public.personas.id;
          public          postgres    false    227         �            1259    34123    recipes    TABLE     �   CREATE TABLE public.recipes (
    id integer NOT NULL,
    receta character varying(400) NOT NULL,
    f_inicio date NOT NULL,
    fk_medicamento integer,
    fk_historia_medica integer,
    f_fin date NOT NULL
);
    DROP TABLE public.recipes;
       public         heap    postgres    false         �            1259    34126    recipes_id_seq    SEQUENCE     �   CREATE SEQUENCE public.recipes_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 %   DROP SEQUENCE public.recipes_id_seq;
       public          postgres    false    228         5           0    0    recipes_id_seq    SEQUENCE OWNED BY     A   ALTER SEQUENCE public.recipes_id_seq OWNED BY public.recipes.id;
          public          postgres    false    229         �            1259    34128    reposo    TABLE     �   CREATE TABLE public.reposo (
    id integer NOT NULL,
    descripcion character varying(400) NOT NULL,
    f_inicio date NOT NULL,
    fk_historia_medica integer,
    f_fin date NOT NULL
);
    DROP TABLE public.reposo;
       public         heap    postgres    false         �            1259    34131    reposo_id_seq    SEQUENCE     �   CREATE SEQUENCE public.reposo_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 $   DROP SEQUENCE public.reposo_id_seq;
       public          postgres    false    230         6           0    0    reposo_id_seq    SEQUENCE OWNED BY     ?   ALTER SEQUENCE public.reposo_id_seq OWNED BY public.reposo.id;
          public          postgres    false    231         �            1259    34133    roles    TABLE     �   CREATE TABLE public.roles (
    id integer NOT NULL,
    nombre character varying(100) NOT NULL,
    estatus integer NOT NULL,
    valor integer NOT NULL,
    descripcion character(100) NOT NULL,
    fk_cargo integer
);
    DROP TABLE public.roles;
       public         heap    postgres    false         �            1259    34136    roles_id_seq    SEQUENCE     �   CREATE SEQUENCE public.roles_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 #   DROP SEQUENCE public.roles_id_seq;
       public          postgres    false    232         7           0    0    roles_id_seq    SEQUENCE OWNED BY     =   ALTER SEQUENCE public.roles_id_seq OWNED BY public.roles.id;
          public          postgres    false    233         �            1259    34138 
   roles_menu    TABLE     }   CREATE TABLE public.roles_menu (
    id integer NOT NULL,
    fk_rol integer,
    fk_menu integer,
    fk_submenu integer
);
    DROP TABLE public.roles_menu;
       public         heap    postgres    false         �            1259    34141    roles_menu_id_seq    SEQUENCE     �   CREATE SEQUENCE public.roles_menu_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 (   DROP SEQUENCE public.roles_menu_id_seq;
       public          postgres    false    234         8           0    0    roles_menu_id_seq    SEQUENCE OWNED BY     G   ALTER SEQUENCE public.roles_menu_id_seq OWNED BY public.roles_menu.id;
          public          postgres    false    235         �            1259    34143 	   servicios    TABLE     �   CREATE TABLE public.servicios (
    id integer NOT NULL,
    nombre character varying(100) NOT NULL,
    estatus integer NOT NULL,
    valor integer NOT NULL,
    descripcion character varying(100) NOT NULL
);
    DROP TABLE public.servicios;
       public         heap    postgres    false         �            1259    34146    servicios_id_seq    SEQUENCE     �   CREATE SEQUENCE public.servicios_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 '   DROP SEQUENCE public.servicios_id_seq;
       public          postgres    false    236         9           0    0    servicios_id_seq    SEQUENCE OWNED BY     E   ALTER SEQUENCE public.servicios_id_seq OWNED BY public.servicios.id;
          public          postgres    false    237         �            1259    34148    submenus    TABLE     �   CREATE TABLE public.submenus (
    id integer NOT NULL,
    fk_menus integer,
    nombre character varying(50),
    url character varying(100),
    icono character varying(300),
    orden integer
);
    DROP TABLE public.submenus;
       public         heap    postgres    false         �            1259    34151    submenu_id_seq    SEQUENCE     �   CREATE SEQUENCE public.submenu_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 %   DROP SEQUENCE public.submenu_id_seq;
       public          postgres    false    238         :           0    0    submenu_id_seq    SEQUENCE OWNED BY     B   ALTER SEQUENCE public.submenu_id_seq OWNED BY public.submenus.id;
          public          postgres    false    239         �            1259    34153    tipo_medicamentos    TABLE     �   CREATE TABLE public.tipo_medicamentos (
    id integer NOT NULL,
    nombre character varying(400) NOT NULL,
    descripcion character varying(400) NOT NULL
);
 %   DROP TABLE public.tipo_medicamentos;
       public         heap    postgres    false         �            1259    34159    tipo_medicamentos_id_seq    SEQUENCE     �   CREATE SEQUENCE public.tipo_medicamentos_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 /   DROP SEQUENCE public.tipo_medicamentos_id_seq;
       public          postgres    false    240         ;           0    0    tipo_medicamentos_id_seq    SEQUENCE OWNED BY     U   ALTER SEQUENCE public.tipo_medicamentos_id_seq OWNED BY public.tipo_medicamentos.id;
          public          postgres    false    241         �            1259    34161    unidadmedida    TABLE     �   CREATE TABLE public.unidadmedida (
    id integer NOT NULL,
    nombre character varying(140),
    descripcion character varying(140)
);
     DROP TABLE public.unidadmedida;
       public         heap    postgres    false         �            1259    34164    unidadmedida_id_seq    SEQUENCE     �   CREATE SEQUENCE public.unidadmedida_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 *   DROP SEQUENCE public.unidadmedida_id_seq;
       public          postgres    false    242         <           0    0    unidadmedida_id_seq    SEQUENCE OWNED BY     K   ALTER SEQUENCE public.unidadmedida_id_seq OWNED BY public.unidadmedida.id;
          public          postgres    false    243         �            1259    34166 
   unidadpeso    TABLE     �   CREATE TABLE public.unidadpeso (
    id integer NOT NULL,
    nombre character varying(140),
    descripcion character varying(140)
);
    DROP TABLE public.unidadpeso;
       public         heap    postgres    false         �            1259    34169    unidadpeso_id_seq    SEQUENCE     �   CREATE SEQUENCE public.unidadpeso_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 (   DROP SEQUENCE public.unidadpeso_id_seq;
       public          postgres    false    244         =           0    0    unidadpeso_id_seq    SEQUENCE OWNED BY     G   ALTER SEQUENCE public.unidadpeso_id_seq OWNED BY public.unidadpeso.id;
          public          postgres    false    245         �            1259    34171    usuarios    TABLE     "  CREATE TABLE public.usuarios (
    id integer NOT NULL,
    foto character varying(100) NOT NULL,
    clave character varying(100) NOT NULL,
    fk_rol integer NOT NULL,
    fk_persona integer NOT NULL,
    fk_servicio integer NOT NULL,
    estatus integer,
    cedula character varying
);
    DROP TABLE public.usuarios;
       public         heap    postgres    false         �            1259    34177    usuario_id_seq    SEQUENCE     �   CREATE SEQUENCE public.usuario_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 %   DROP SEQUENCE public.usuario_id_seq;
       public          postgres    false    246         >           0    0    usuario_id_seq    SEQUENCE OWNED BY     B   ALTER SEQUENCE public.usuario_id_seq OWNED BY public.usuarios.id;
          public          postgres    false    247         	           2604    34179    asignaciones id    DEFAULT     r   ALTER TABLE ONLY public.asignaciones ALTER COLUMN id SET DEFAULT nextval('public.asignaciones_id_seq'::regclass);
 >   ALTER TABLE public.asignaciones ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    203    202                    2604    34180 	   cargos id    DEFAULT     e   ALTER TABLE ONLY public.cargos ALTER COLUMN id SET DEFAULT nextval('public.cargo_id_seq'::regclass);
 8   ALTER TABLE public.cargos ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    205    204                    2604    34181    citas id    DEFAULT     d   ALTER TABLE ONLY public.citas ALTER COLUMN id SET DEFAULT nextval('public.citas_id_seq'::regclass);
 7   ALTER TABLE public.citas ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    209    206                    2604    34182    citas_enfermeria id    DEFAULT     z   ALTER TABLE ONLY public.citas_enfermeria ALTER COLUMN id SET DEFAULT nextval('public.citas_enfermeria_id_seq'::regclass);
 B   ALTER TABLE public.citas_enfermeria ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    208    207                    2604    34183    componentesactivos id    DEFAULT     ~   ALTER TABLE ONLY public.componentesactivos ALTER COLUMN id SET DEFAULT nextval('public.componentesactivos_id_seq'::regclass);
 D   ALTER TABLE public.componentesactivos ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    211    210                    2604    34184    consultorios id    DEFAULT     r   ALTER TABLE ONLY public.consultorios ALTER COLUMN id SET DEFAULT nextval('public.consultorios_id_seq'::regclass);
 >   ALTER TABLE public.consultorios ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    213    212                    2604    34185    historias_medicas id    DEFAULT     |   ALTER TABLE ONLY public.historias_medicas ALTER COLUMN id SET DEFAULT nextval('public.historias_medicas_id_seq'::regclass);
 C   ALTER TABLE public.historias_medicas ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    215    214                    2604    34186    laboratorios id    DEFAULT     r   ALTER TABLE ONLY public.laboratorios ALTER COLUMN id SET DEFAULT nextval('public.laboratorios_id_seq'::regclass);
 >   ALTER TABLE public.laboratorios ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    217    216                    2604    34187    medicamentos id    DEFAULT     r   ALTER TABLE ONLY public.medicamentos ALTER COLUMN id SET DEFAULT nextval('public.medicamentos_id_seq'::regclass);
 >   ALTER TABLE public.medicamentos ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    219    218                    2604    34188    menu_usuario id    DEFAULT     r   ALTER TABLE ONLY public.menu_usuario ALTER COLUMN id SET DEFAULT nextval('public.menu_usuario_id_seq'::regclass);
 >   ALTER TABLE public.menu_usuario ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    223    222                    2604    34189    menus id    DEFAULT     c   ALTER TABLE ONLY public.menus ALTER COLUMN id SET DEFAULT nextval('public.menu_id_seq'::regclass);
 7   ALTER TABLE public.menus ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    221    220                    2604    34190    patologias id    DEFAULT     n   ALTER TABLE ONLY public.patologias ALTER COLUMN id SET DEFAULT nextval('public.patologias_id_seq'::regclass);
 <   ALTER TABLE public.patologias ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    225    224                    2604    34191    personas id    DEFAULT     j   ALTER TABLE ONLY public.personas ALTER COLUMN id SET DEFAULT nextval('public.personas_id_seq'::regclass);
 :   ALTER TABLE public.personas ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    227    226                    2604    34192 
   recipes id    DEFAULT     h   ALTER TABLE ONLY public.recipes ALTER COLUMN id SET DEFAULT nextval('public.recipes_id_seq'::regclass);
 9   ALTER TABLE public.recipes ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    229    228                    2604    34193 	   reposo id    DEFAULT     f   ALTER TABLE ONLY public.reposo ALTER COLUMN id SET DEFAULT nextval('public.reposo_id_seq'::regclass);
 8   ALTER TABLE public.reposo ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    231    230                    2604    34194    roles id    DEFAULT     d   ALTER TABLE ONLY public.roles ALTER COLUMN id SET DEFAULT nextval('public.roles_id_seq'::regclass);
 7   ALTER TABLE public.roles ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    233    232                    2604    34195    roles_menu id    DEFAULT     n   ALTER TABLE ONLY public.roles_menu ALTER COLUMN id SET DEFAULT nextval('public.roles_menu_id_seq'::regclass);
 <   ALTER TABLE public.roles_menu ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    235    234                    2604    34196    servicios id    DEFAULT     l   ALTER TABLE ONLY public.servicios ALTER COLUMN id SET DEFAULT nextval('public.servicios_id_seq'::regclass);
 ;   ALTER TABLE public.servicios ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    237    236                    2604    34197    submenus id    DEFAULT     i   ALTER TABLE ONLY public.submenus ALTER COLUMN id SET DEFAULT nextval('public.submenu_id_seq'::regclass);
 :   ALTER TABLE public.submenus ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    239    238                     2604    34198    tipo_medicamentos id    DEFAULT     |   ALTER TABLE ONLY public.tipo_medicamentos ALTER COLUMN id SET DEFAULT nextval('public.tipo_medicamentos_id_seq'::regclass);
 C   ALTER TABLE public.tipo_medicamentos ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    241    240         !           2604    34199    unidadmedida id    DEFAULT     r   ALTER TABLE ONLY public.unidadmedida ALTER COLUMN id SET DEFAULT nextval('public.unidadmedida_id_seq'::regclass);
 >   ALTER TABLE public.unidadmedida ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    243    242         "           2604    34200    unidadpeso id    DEFAULT     n   ALTER TABLE ONLY public.unidadpeso ALTER COLUMN id SET DEFAULT nextval('public.unidadpeso_id_seq'::regclass);
 <   ALTER TABLE public.unidadpeso ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    245    244         #           2604    34201    usuarios id    DEFAULT     i   ALTER TABLE ONLY public.usuarios ALTER COLUMN id SET DEFAULT nextval('public.usuario_id_seq'::regclass);
 :   ALTER TABLE public.usuarios ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    247    246         �          0    34048    asignaciones 
   TABLE DATA           s   COPY public.asignaciones (id, nombre, estatus, descripcion, f_inicio, f_fin, fk_usuario, fk_servicios) FROM stdin;
    public          postgres    false    202       3060.dat �          0    34053    cargos 
   TABLE DATA           O   COPY public.cargos (id, nombre, descripcion, estatus, fk_servicio) FROM stdin;
    public          postgres    false    204       3062.dat �          0    34060    citas 
   TABLE DATA           �   COPY public.citas (id, fk_persona, fk_servicio, fk_usuario, fecha, hora, estatus, fk_usuario_sesion, fk_consultorio) FROM stdin;
    public          postgres    false    206       3064.dat �          0    34063    citas_enfermeria 
   TABLE DATA           N   COPY public.citas_enfermeria (id, altura, peso, tension, fk_cita) FROM stdin;
    public          postgres    false    207       3065.dat �          0    34070    componentesactivos 
   TABLE DATA           E   COPY public.componentesactivos (id, nombre, descripcion) FROM stdin;
    public          postgres    false    210       3068.dat �          0    34075    consultorios 
   TABLE DATA           H   COPY public.consultorios (id, nombre, descripcion, estatus) FROM stdin;
    public          postgres    false    212       3070.dat            0    34080    historias_medicas 
   TABLE DATA           n   COPY public.historias_medicas (id, diagnostico, fk_patologia, fk_laboratorio, fk_cita_enfermeria) FROM stdin;
    public          postgres    false    214       3072.dat           0    34085    laboratorios 
   TABLE DATA           O   COPY public.laboratorios (id, nombre, estatus, valor, descripcion) FROM stdin;
    public          postgres    false    216       3074.dat           0    34090    medicamentos 
   TABLE DATA           �   COPY public.medicamentos (id, nombre_comercial, descripcion, cantidad, fk_componentesactivos, fk_tipo_medicamento, fk_unidadmedida, fk_unidadpeso) FROM stdin;
    public          postgres    false    218       3076.dat           0    34103    menu_usuario 
   TABLE DATA           K   COPY public.menu_usuario (id, fk_usuario, fk_menu, fk_submenu) FROM stdin;
    public          postgres    false    222       3080.dat           0    34098    menus 
   TABLE DATA           >   COPY public.menus (id, nombre, url, icono, orden) FROM stdin;
    public          postgres    false    220       3078.dat 
          0    34108 
   patologias 
   TABLE DATA           U   COPY public.patologias (id, nombre, estatus, valor, descripcion, alerta) FROM stdin;
    public          postgres    false    224       3082.dat           0    34113    personas 
   TABLE DATA           �   COPY public.personas (id, nombre, apellido, cedula, telefono, correo, sexo, direccion, f_nacimiento, estatus, segundo_nombre, segundo_apellido) FROM stdin;
    public          postgres    false    226       3084.dat           0    34123    recipes 
   TABLE DATA           b   COPY public.recipes (id, receta, f_inicio, fk_medicamento, fk_historia_medica, f_fin) FROM stdin;
    public          postgres    false    228       3086.dat           0    34128    reposo 
   TABLE DATA           V   COPY public.reposo (id, descripcion, f_inicio, fk_historia_medica, f_fin) FROM stdin;
    public          postgres    false    230       3088.dat           0    34133    roles 
   TABLE DATA           R   COPY public.roles (id, nombre, estatus, valor, descripcion, fk_cargo) FROM stdin;
    public          postgres    false    232       3090.dat           0    34138 
   roles_menu 
   TABLE DATA           E   COPY public.roles_menu (id, fk_rol, fk_menu, fk_submenu) FROM stdin;
    public          postgres    false    234       3092.dat           0    34143 	   servicios 
   TABLE DATA           L   COPY public.servicios (id, nombre, estatus, valor, descripcion) FROM stdin;
    public          postgres    false    236       3094.dat           0    34148    submenus 
   TABLE DATA           K   COPY public.submenus (id, fk_menus, nombre, url, icono, orden) FROM stdin;
    public          postgres    false    238       3096.dat           0    34153    tipo_medicamentos 
   TABLE DATA           D   COPY public.tipo_medicamentos (id, nombre, descripcion) FROM stdin;
    public          postgres    false    240       3098.dat           0    34161    unidadmedida 
   TABLE DATA           ?   COPY public.unidadmedida (id, nombre, descripcion) FROM stdin;
    public          postgres    false    242       3100.dat           0    34166 
   unidadpeso 
   TABLE DATA           =   COPY public.unidadpeso (id, nombre, descripcion) FROM stdin;
    public          postgres    false    244       3102.dat            0    34171    usuarios 
   TABLE DATA           e   COPY public.usuarios (id, foto, clave, fk_rol, fk_persona, fk_servicio, estatus, cedula) FROM stdin;
    public          postgres    false    246       3104.dat ?           0    0    asignaciones_id_seq    SEQUENCE SET     A   SELECT pg_catalog.setval('public.asignaciones_id_seq', 4, true);
          public          postgres    false    203         @           0    0    cargo_id_seq    SEQUENCE SET     ;   SELECT pg_catalog.setval('public.cargo_id_seq', 13, true);
          public          postgres    false    205         A           0    0    citas_enfermeria_id_seq    SEQUENCE SET     E   SELECT pg_catalog.setval('public.citas_enfermeria_id_seq', 9, true);
          public          postgres    false    208         B           0    0    citas_id_seq    SEQUENCE SET     ;   SELECT pg_catalog.setval('public.citas_id_seq', 39, true);
          public          postgres    false    209         C           0    0    componentesactivos_id_seq    SEQUENCE SET     H   SELECT pg_catalog.setval('public.componentesactivos_id_seq', 14, true);
          public          postgres    false    211         D           0    0    consultorios_id_seq    SEQUENCE SET     A   SELECT pg_catalog.setval('public.consultorios_id_seq', 4, true);
          public          postgres    false    213         E           0    0    historias_medicas_id_seq    SEQUENCE SET     G   SELECT pg_catalog.setval('public.historias_medicas_id_seq', 29, true);
          public          postgres    false    215         F           0    0    laboratorios_id_seq    SEQUENCE SET     A   SELECT pg_catalog.setval('public.laboratorios_id_seq', 9, true);
          public          postgres    false    217         G           0    0    medicamentos_id_seq    SEQUENCE SET     A   SELECT pg_catalog.setval('public.medicamentos_id_seq', 9, true);
          public          postgres    false    219         H           0    0    menu_id_seq    SEQUENCE SET     :   SELECT pg_catalog.setval('public.menu_id_seq', 15, true);
          public          postgres    false    221         I           0    0    menu_usuario_id_seq    SEQUENCE SET     C   SELECT pg_catalog.setval('public.menu_usuario_id_seq', 351, true);
          public          postgres    false    223         J           0    0    patologias_id_seq    SEQUENCE SET     @   SELECT pg_catalog.setval('public.patologias_id_seq', 11, true);
          public          postgres    false    225         K           0    0    personas_id_seq    SEQUENCE SET     >   SELECT pg_catalog.setval('public.personas_id_seq', 35, true);
          public          postgres    false    227         L           0    0    recipes_id_seq    SEQUENCE SET     <   SELECT pg_catalog.setval('public.recipes_id_seq', 4, true);
          public          postgres    false    229         M           0    0    reposo_id_seq    SEQUENCE SET     <   SELECT pg_catalog.setval('public.reposo_id_seq', 11, true);
          public          postgres    false    231         N           0    0    roles_id_seq    SEQUENCE SET     ;   SELECT pg_catalog.setval('public.roles_id_seq', 21, true);
          public          postgres    false    233         O           0    0    roles_menu_id_seq    SEQUENCE SET     @   SELECT pg_catalog.setval('public.roles_menu_id_seq', 59, true);
          public          postgres    false    235         P           0    0    servicios_id_seq    SEQUENCE SET     ?   SELECT pg_catalog.setval('public.servicios_id_seq', 13, true);
          public          postgres    false    237         Q           0    0    submenu_id_seq    SEQUENCE SET     =   SELECT pg_catalog.setval('public.submenu_id_seq', 38, true);
          public          postgres    false    239         R           0    0    tipo_medicamentos_id_seq    SEQUENCE SET     G   SELECT pg_catalog.setval('public.tipo_medicamentos_id_seq', 21, true);
          public          postgres    false    241         S           0    0    unidadmedida_id_seq    SEQUENCE SET     B   SELECT pg_catalog.setval('public.unidadmedida_id_seq', 25, true);
          public          postgres    false    243         T           0    0    unidadpeso_id_seq    SEQUENCE SET     ?   SELECT pg_catalog.setval('public.unidadpeso_id_seq', 6, true);
          public          postgres    false    245         U           0    0    usuario_id_seq    SEQUENCE SET     =   SELECT pg_catalog.setval('public.usuario_id_seq', 42, true);
          public          postgres    false    247         %           2606    34203    asignaciones asignaciones_pkey 
   CONSTRAINT     \   ALTER TABLE ONLY public.asignaciones
    ADD CONSTRAINT asignaciones_pkey PRIMARY KEY (id);
 H   ALTER TABLE ONLY public.asignaciones DROP CONSTRAINT asignaciones_pkey;
       public            postgres    false    202         '           2606    34205    cargos cargo_pkey 
   CONSTRAINT     O   ALTER TABLE ONLY public.cargos
    ADD CONSTRAINT cargo_pkey PRIMARY KEY (id);
 ;   ALTER TABLE ONLY public.cargos DROP CONSTRAINT cargo_pkey;
       public            postgres    false    204         =           2606    34207    personas cedula_unico 
   CONSTRAINT     R   ALTER TABLE ONLY public.personas
    ADD CONSTRAINT cedula_unico UNIQUE (cedula);
 ?   ALTER TABLE ONLY public.personas DROP CONSTRAINT cedula_unico;
       public            postgres    false    226         +           2606    34209 &   citas_enfermeria citas_enfermeria_pkey 
   CONSTRAINT     d   ALTER TABLE ONLY public.citas_enfermeria
    ADD CONSTRAINT citas_enfermeria_pkey PRIMARY KEY (id);
 P   ALTER TABLE ONLY public.citas_enfermeria DROP CONSTRAINT citas_enfermeria_pkey;
       public            postgres    false    207         )           2606    34211    citas citas_pkey 
   CONSTRAINT     N   ALTER TABLE ONLY public.citas
    ADD CONSTRAINT citas_pkey PRIMARY KEY (id);
 :   ALTER TABLE ONLY public.citas DROP CONSTRAINT citas_pkey;
       public            postgres    false    206         -           2606    34213 *   componentesactivos componentesactivos_pkey 
   CONSTRAINT     h   ALTER TABLE ONLY public.componentesactivos
    ADD CONSTRAINT componentesactivos_pkey PRIMARY KEY (id);
 T   ALTER TABLE ONLY public.componentesactivos DROP CONSTRAINT componentesactivos_pkey;
       public            postgres    false    210         /           2606    34215    consultorios consultorios_pkey 
   CONSTRAINT     \   ALTER TABLE ONLY public.consultorios
    ADD CONSTRAINT consultorios_pkey PRIMARY KEY (id);
 H   ALTER TABLE ONLY public.consultorios DROP CONSTRAINT consultorios_pkey;
       public            postgres    false    212         1           2606    34217 (   historias_medicas historias_medicas_pkey 
   CONSTRAINT     f   ALTER TABLE ONLY public.historias_medicas
    ADD CONSTRAINT historias_medicas_pkey PRIMARY KEY (id);
 R   ALTER TABLE ONLY public.historias_medicas DROP CONSTRAINT historias_medicas_pkey;
       public            postgres    false    214         3           2606    34219    laboratorios laboratorios_pkey 
   CONSTRAINT     \   ALTER TABLE ONLY public.laboratorios
    ADD CONSTRAINT laboratorios_pkey PRIMARY KEY (id);
 H   ALTER TABLE ONLY public.laboratorios DROP CONSTRAINT laboratorios_pkey;
       public            postgres    false    216         5           2606    34221    medicamentos medicamentos_pkey 
   CONSTRAINT     \   ALTER TABLE ONLY public.medicamentos
    ADD CONSTRAINT medicamentos_pkey PRIMARY KEY (id);
 H   ALTER TABLE ONLY public.medicamentos DROP CONSTRAINT medicamentos_pkey;
       public            postgres    false    218         7           2606    34223    menus menu_pkey 
   CONSTRAINT     M   ALTER TABLE ONLY public.menus
    ADD CONSTRAINT menu_pkey PRIMARY KEY (id);
 9   ALTER TABLE ONLY public.menus DROP CONSTRAINT menu_pkey;
       public            postgres    false    220         9           2606    34225    menu_usuario menu_usuario_pkey 
   CONSTRAINT     \   ALTER TABLE ONLY public.menu_usuario
    ADD CONSTRAINT menu_usuario_pkey PRIMARY KEY (id);
 H   ALTER TABLE ONLY public.menu_usuario DROP CONSTRAINT menu_usuario_pkey;
       public            postgres    false    222         ;           2606    34227    patologias patologias_pkey 
   CONSTRAINT     X   ALTER TABLE ONLY public.patologias
    ADD CONSTRAINT patologias_pkey PRIMARY KEY (id);
 D   ALTER TABLE ONLY public.patologias DROP CONSTRAINT patologias_pkey;
       public            postgres    false    224         ?           2606    34229    personas personas_cedula_key 
   CONSTRAINT     Y   ALTER TABLE ONLY public.personas
    ADD CONSTRAINT personas_cedula_key UNIQUE (cedula);
 F   ALTER TABLE ONLY public.personas DROP CONSTRAINT personas_cedula_key;
       public            postgres    false    226         A           2606    34231    personas personas_correo_key 
   CONSTRAINT     Y   ALTER TABLE ONLY public.personas
    ADD CONSTRAINT personas_correo_key UNIQUE (correo);
 F   ALTER TABLE ONLY public.personas DROP CONSTRAINT personas_correo_key;
       public            postgres    false    226         C           2606    34233    personas personas_pkey 
   CONSTRAINT     T   ALTER TABLE ONLY public.personas
    ADD CONSTRAINT personas_pkey PRIMARY KEY (id);
 @   ALTER TABLE ONLY public.personas DROP CONSTRAINT personas_pkey;
       public            postgres    false    226         G           2606    34235    recipes recipes_pkey 
   CONSTRAINT     R   ALTER TABLE ONLY public.recipes
    ADD CONSTRAINT recipes_pkey PRIMARY KEY (id);
 >   ALTER TABLE ONLY public.recipes DROP CONSTRAINT recipes_pkey;
       public            postgres    false    228         I           2606    34237    reposo reposo_pkey 
   CONSTRAINT     P   ALTER TABLE ONLY public.reposo
    ADD CONSTRAINT reposo_pkey PRIMARY KEY (id);
 <   ALTER TABLE ONLY public.reposo DROP CONSTRAINT reposo_pkey;
       public            postgres    false    230         M           2606    34239    roles_menu roles_menu_pkey 
   CONSTRAINT     X   ALTER TABLE ONLY public.roles_menu
    ADD CONSTRAINT roles_menu_pkey PRIMARY KEY (id);
 D   ALTER TABLE ONLY public.roles_menu DROP CONSTRAINT roles_menu_pkey;
       public            postgres    false    234         K           2606    34241    roles roles_pkey 
   CONSTRAINT     N   ALTER TABLE ONLY public.roles
    ADD CONSTRAINT roles_pkey PRIMARY KEY (id);
 :   ALTER TABLE ONLY public.roles DROP CONSTRAINT roles_pkey;
       public            postgres    false    232         O           2606    34243    servicios servicios_pkey 
   CONSTRAINT     V   ALTER TABLE ONLY public.servicios
    ADD CONSTRAINT servicios_pkey PRIMARY KEY (id);
 B   ALTER TABLE ONLY public.servicios DROP CONSTRAINT servicios_pkey;
       public            postgres    false    236         Q           2606    34245    submenus submenu_pkey 
   CONSTRAINT     S   ALTER TABLE ONLY public.submenus
    ADD CONSTRAINT submenu_pkey PRIMARY KEY (id);
 ?   ALTER TABLE ONLY public.submenus DROP CONSTRAINT submenu_pkey;
       public            postgres    false    238         S           2606    34247 (   tipo_medicamentos tipo_medicamentos_pkey 
   CONSTRAINT     f   ALTER TABLE ONLY public.tipo_medicamentos
    ADD CONSTRAINT tipo_medicamentos_pkey PRIMARY KEY (id);
 R   ALTER TABLE ONLY public.tipo_medicamentos DROP CONSTRAINT tipo_medicamentos_pkey;
       public            postgres    false    240         U           2606    34249    unidadmedida unidadmedida_pkey 
   CONSTRAINT     \   ALTER TABLE ONLY public.unidadmedida
    ADD CONSTRAINT unidadmedida_pkey PRIMARY KEY (id);
 H   ALTER TABLE ONLY public.unidadmedida DROP CONSTRAINT unidadmedida_pkey;
       public            postgres    false    242         W           2606    34251    unidadpeso unidadpeso_pkey 
   CONSTRAINT     X   ALTER TABLE ONLY public.unidadpeso
    ADD CONSTRAINT unidadpeso_pkey PRIMARY KEY (id);
 D   ALTER TABLE ONLY public.unidadpeso DROP CONSTRAINT unidadpeso_pkey;
       public            postgres    false    244         E           2606    34253    personas unique_cedula 
   CONSTRAINT     S   ALTER TABLE ONLY public.personas
    ADD CONSTRAINT unique_cedula UNIQUE (cedula);
 @   ALTER TABLE ONLY public.personas DROP CONSTRAINT unique_cedula;
       public            postgres    false    226         Y           2606    34255    usuarios usuario_pkey 
   CONSTRAINT     S   ALTER TABLE ONLY public.usuarios
    ADD CONSTRAINT usuario_pkey PRIMARY KEY (id);
 ?   ALTER TABLE ONLY public.usuarios DROP CONSTRAINT usuario_pkey;
       public            postgres    false    246         `           2606    34256 .   citas_enfermeria citas_enfermeria_fk_cita_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.citas_enfermeria
    ADD CONSTRAINT citas_enfermeria_fk_cita_fkey FOREIGN KEY (fk_cita) REFERENCES public.citas(id);
 X   ALTER TABLE ONLY public.citas_enfermeria DROP CONSTRAINT citas_enfermeria_fk_cita_fkey;
       public          postgres    false    207    206    2857         Z           2606    34261 &   asignaciones fk_asignaciones_servicios    FK CONSTRAINT     �   ALTER TABLE ONLY public.asignaciones
    ADD CONSTRAINT fk_asignaciones_servicios FOREIGN KEY (fk_servicios) REFERENCES public.servicios(id);
 P   ALTER TABLE ONLY public.asignaciones DROP CONSTRAINT fk_asignaciones_servicios;
       public          postgres    false    202    236    2895         n           2606    34266    roles fk_cargo    FK CONSTRAINT     o   ALTER TABLE ONLY public.roles
    ADD CONSTRAINT fk_cargo FOREIGN KEY (fk_cargo) REFERENCES public.cargos(id);
 8   ALTER TABLE ONLY public.roles DROP CONSTRAINT fk_cargo;
       public          postgres    false    204    2855    232         d           2606    34271 "   medicamentos fk_componentesactivos    FK CONSTRAINT     �   ALTER TABLE ONLY public.medicamentos
    ADD CONSTRAINT fk_componentesactivos FOREIGN KEY (fk_componentesactivos) REFERENCES public.componentesactivos(id);
 L   ALTER TABLE ONLY public.medicamentos DROP CONSTRAINT fk_componentesactivos;
       public          postgres    false    210    2861    218         \           2606    34276    citas fk_consultorio    FK CONSTRAINT     �   ALTER TABLE ONLY public.citas
    ADD CONSTRAINT fk_consultorio FOREIGN KEY (fk_consultorio) REFERENCES public.consultorios(id);
 >   ALTER TABLE ONLY public.citas DROP CONSTRAINT fk_consultorio;
       public          postgres    false    206    2863    212         ]           2606    34281    citas fk_persona    FK CONSTRAINT     u   ALTER TABLE ONLY public.citas
    ADD CONSTRAINT fk_persona FOREIGN KEY (fk_persona) REFERENCES public.personas(id);
 :   ALTER TABLE ONLY public.citas DROP CONSTRAINT fk_persona;
       public          postgres    false    226    2883    206         ^           2606    34286    citas fk_servicio    FK CONSTRAINT     x   ALTER TABLE ONLY public.citas
    ADD CONSTRAINT fk_servicio FOREIGN KEY (fk_servicio) REFERENCES public.servicios(id);
 ;   ALTER TABLE ONLY public.citas DROP CONSTRAINT fk_servicio;
       public          postgres    false    2895    206    236         [           2606    34291    cargos fk_servicio    FK CONSTRAINT     y   ALTER TABLE ONLY public.cargos
    ADD CONSTRAINT fk_servicio FOREIGN KEY (fk_servicio) REFERENCES public.servicios(id);
 <   ALTER TABLE ONLY public.cargos DROP CONSTRAINT fk_servicio;
       public          postgres    false    204    236    2895         e           2606    34296     medicamentos fk_tipo_medicamento    FK CONSTRAINT     �   ALTER TABLE ONLY public.medicamentos
    ADD CONSTRAINT fk_tipo_medicamento FOREIGN KEY (fk_tipo_medicamento) REFERENCES public.tipo_medicamentos(id);
 J   ALTER TABLE ONLY public.medicamentos DROP CONSTRAINT fk_tipo_medicamento;
       public          postgres    false    218    240    2899         f           2606    34301    medicamentos fk_unidadmedida    FK CONSTRAINT     �   ALTER TABLE ONLY public.medicamentos
    ADD CONSTRAINT fk_unidadmedida FOREIGN KEY (fk_unidadmedida) REFERENCES public.unidadmedida(id);
 F   ALTER TABLE ONLY public.medicamentos DROP CONSTRAINT fk_unidadmedida;
       public          postgres    false    2901    242    218         g           2606    34306    medicamentos fk_unidadpeso    FK CONSTRAINT     �   ALTER TABLE ONLY public.medicamentos
    ADD CONSTRAINT fk_unidadpeso FOREIGN KEY (fk_unidadpeso) REFERENCES public.unidadpeso(id);
 D   ALTER TABLE ONLY public.medicamentos DROP CONSTRAINT fk_unidadpeso;
       public          postgres    false    218    244    2903         _           2606    34311    citas fk_usuario    FK CONSTRAINT     u   ALTER TABLE ONLY public.citas
    ADD CONSTRAINT fk_usuario FOREIGN KEY (fk_usuario) REFERENCES public.usuarios(id);
 :   ALTER TABLE ONLY public.citas DROP CONSTRAINT fk_usuario;
       public          postgres    false    206    246    2905         s           2606    34316    usuarios fk_usuario_persona    FK CONSTRAINT     �   ALTER TABLE ONLY public.usuarios
    ADD CONSTRAINT fk_usuario_persona FOREIGN KEY (fk_persona) REFERENCES public.personas(id) ON DELETE CASCADE;
 E   ALTER TABLE ONLY public.usuarios DROP CONSTRAINT fk_usuario_persona;
       public          postgres    false    246    226    2883         t           2606    34321    usuarios fk_usuario_servicio    FK CONSTRAINT     �   ALTER TABLE ONLY public.usuarios
    ADD CONSTRAINT fk_usuario_servicio FOREIGN KEY (fk_servicio) REFERENCES public.servicios(id) ON DELETE CASCADE;
 F   ALTER TABLE ONLY public.usuarios DROP CONSTRAINT fk_usuario_servicio;
       public          postgres    false    246    236    2895         a           2606    34326 ;   historias_medicas historias_medicas_fk_cita_enfermeria_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.historias_medicas
    ADD CONSTRAINT historias_medicas_fk_cita_enfermeria_fkey FOREIGN KEY (fk_cita_enfermeria) REFERENCES public.citas_enfermeria(id);
 e   ALTER TABLE ONLY public.historias_medicas DROP CONSTRAINT historias_medicas_fk_cita_enfermeria_fkey;
       public          postgres    false    214    207    2859         b           2606    34331 7   historias_medicas historias_medicas_fk_laboratorio_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.historias_medicas
    ADD CONSTRAINT historias_medicas_fk_laboratorio_fkey FOREIGN KEY (fk_laboratorio) REFERENCES public.laboratorios(id);
 a   ALTER TABLE ONLY public.historias_medicas DROP CONSTRAINT historias_medicas_fk_laboratorio_fkey;
       public          postgres    false    2867    216    214         c           2606    34336 5   historias_medicas historias_medicas_fk_patologia_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.historias_medicas
    ADD CONSTRAINT historias_medicas_fk_patologia_fkey FOREIGN KEY (fk_patologia) REFERENCES public.patologias(id) NOT VALID;
 _   ALTER TABLE ONLY public.historias_medicas DROP CONSTRAINT historias_medicas_fk_patologia_fkey;
       public          postgres    false    2875    214    224         i           2606    50236 &   menu_usuario menu_usuario_fk_menu_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.menu_usuario
    ADD CONSTRAINT menu_usuario_fk_menu_fkey FOREIGN KEY (fk_menu) REFERENCES public.menus(id) NOT VALID;
 P   ALTER TABLE ONLY public.menu_usuario DROP CONSTRAINT menu_usuario_fk_menu_fkey;
       public          postgres    false    220    222    2871         j           2606    50241 )   menu_usuario menu_usuario_fk_submenu_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.menu_usuario
    ADD CONSTRAINT menu_usuario_fk_submenu_fkey FOREIGN KEY (fk_submenu) REFERENCES public.submenus(id) NOT VALID;
 S   ALTER TABLE ONLY public.menu_usuario DROP CONSTRAINT menu_usuario_fk_submenu_fkey;
       public          postgres    false    2897    222    238         h           2606    50228 )   menu_usuario menu_usuario_fk_usuario_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.menu_usuario
    ADD CONSTRAINT menu_usuario_fk_usuario_fkey FOREIGN KEY (fk_usuario) REFERENCES public.usuarios(id) NOT VALID;
 S   ALTER TABLE ONLY public.menu_usuario DROP CONSTRAINT menu_usuario_fk_usuario_fkey;
       public          postgres    false    2905    222    246         k           2606    34351 '   recipes recipes_fk_historia_medica_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.recipes
    ADD CONSTRAINT recipes_fk_historia_medica_fkey FOREIGN KEY (fk_historia_medica) REFERENCES public.historias_medicas(id);
 Q   ALTER TABLE ONLY public.recipes DROP CONSTRAINT recipes_fk_historia_medica_fkey;
       public          postgres    false    2865    214    228         l           2606    34356 #   recipes recipes_fk_medicamento_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.recipes
    ADD CONSTRAINT recipes_fk_medicamento_fkey FOREIGN KEY (fk_medicamento) REFERENCES public.medicamentos(id) NOT VALID;
 M   ALTER TABLE ONLY public.recipes DROP CONSTRAINT recipes_fk_medicamento_fkey;
       public          postgres    false    2869    218    228         m           2606    34361 %   reposo reposo_fk_historia_medica_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.reposo
    ADD CONSTRAINT reposo_fk_historia_medica_fkey FOREIGN KEY (fk_historia_medica) REFERENCES public.historias_medicas(id);
 O   ALTER TABLE ONLY public.reposo DROP CONSTRAINT reposo_fk_historia_medica_fkey;
       public          postgres    false    230    214    2865         o           2606    34366 "   roles_menu roles_menu_fk_menu_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.roles_menu
    ADD CONSTRAINT roles_menu_fk_menu_fkey FOREIGN KEY (fk_menu) REFERENCES public.menus(id) ON UPDATE CASCADE ON DELETE CASCADE NOT VALID;
 L   ALTER TABLE ONLY public.roles_menu DROP CONSTRAINT roles_menu_fk_menu_fkey;
       public          postgres    false    234    220    2871         p           2606    34371 !   roles_menu roles_menu_fk_rol_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.roles_menu
    ADD CONSTRAINT roles_menu_fk_rol_fkey FOREIGN KEY (fk_rol) REFERENCES public.roles(id) ON UPDATE CASCADE ON DELETE CASCADE NOT VALID;
 K   ALTER TABLE ONLY public.roles_menu DROP CONSTRAINT roles_menu_fk_rol_fkey;
       public          postgres    false    234    232    2891         q           2606    34376 %   roles_menu roles_menu_fk_submenu_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.roles_menu
    ADD CONSTRAINT roles_menu_fk_submenu_fkey FOREIGN KEY (fk_submenu) REFERENCES public.submenus(id) ON UPDATE CASCADE ON DELETE CASCADE NOT VALID;
 O   ALTER TABLE ONLY public.roles_menu DROP CONSTRAINT roles_menu_fk_submenu_fkey;
       public          postgres    false    234    238    2897         r           2606    34381    submenus submenu_fk_menu_fkey    FK CONSTRAINT     }   ALTER TABLE ONLY public.submenus
    ADD CONSTRAINT submenu_fk_menu_fkey FOREIGN KEY (fk_menus) REFERENCES public.menus(id);
 G   ALTER TABLE ONLY public.submenus DROP CONSTRAINT submenu_fk_menu_fkey;
       public          postgres    false    220    238    2871         u           2606    34386    usuarios usuarios_fk_rol_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.usuarios
    ADD CONSTRAINT usuarios_fk_rol_fkey FOREIGN KEY (fk_rol) REFERENCES public.roles(id) ON UPDATE CASCADE ON DELETE CASCADE NOT VALID;
 G   ALTER TABLE ONLY public.usuarios DROP CONSTRAINT usuarios_fk_rol_fkey;
       public          postgres    false    232    2891    246                                                                                                                                                                                                                                                        3060.dat                                                                                            0000600 0004000 0002000 00000000005 14677744762 0014265 0                                                                                                    ustar 00postgres                        postgres                        0000000 0000000                                                                                                                                                                        \.


                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           3062.dat                                                                                            0000600 0004000 0002000 00000000637 14677744762 0014302 0                                                                                                    ustar 00postgres                        postgres                        0000000 0000000                                                                                                                                                                        8	ADMINISTRADOR DE SISTEMA	CARGO QUE LLEVA  EL ADMINISTRADOR DEL SISTEMA.	1	8
9	MEDICO GENERAL	MEDICO QUE PUEDE LLEVAR A CABO UNA CONSULTA GENERAL	1	9
10	DOCTORES DE EMERGENCIA	ATIENDEN A CASOS CRITICOS O DELICADOS	1	10
11	ENFERMERO(A)	CARGO QUE LLEVA A CABO LA RECOLECCION DE DATOS FISICOS Y CUIDADO DE PACIENTES	1	11
12	SERVICIOS GENERALES	ESTE CARGO ES PARA LLEVAR A CABO EL MANTENIMIENTO DE LAS AREAS	1	13
\.


                                                                                                 3064.dat                                                                                            0000600 0004000 0002000 00000000305 14677744762 0014274 0                                                                                                    ustar 00postgres                        postgres                        0000000 0000000                                                                                                                                                                        36	33	10	19	2024-07-23	09:00:00	1	22	4
37	29	10	19	2024-07-22	11:30:00	6	22	4
38	25	9	23	2024-10-04	08:00:00	1	20	4
39	25	9	23	2024-10-05	08:00:00	7	20	4
35	29	9	23	2024-10-05	11:30:00	1	20	4
\.


                                                                                                                                                                                                                                                                                                                           3065.dat                                                                                            0000600 0004000 0002000 00000000076 14677744762 0014302 0                                                                                                    ustar 00postgres                        postgres                        0000000 0000000                                                                                                                                                                        7	180	70	120/80	35
8	160	85	120/80	37
9	190	90	120/80	39
\.


                                                                                                                                                                                                                                                                                                                                                                                                                                                                  3068.dat                                                                                            0000600 0004000 0002000 00000000075 14677744762 0014304 0                                                                                                    ustar 00postgres                        postgres                        0000000 0000000                                                                                                                                                                        13	Acetaminofen	Acetaminofen
14	Paracetamol	Paracetamol
\.


                                                                                                                                                                                                                                                                                                                                                                                                                                                                   3070.dat                                                                                            0000600 0004000 0002000 00000000075 14677744762 0014275 0                                                                                                    ustar 00postgres                        postgres                        0000000 0000000                                                                                                                                                                        4	CONSULTORIO 1	Consultorio  para exámenes generales	1
\.


                                                                                                                                                                                                                                                                                                                                                                                                                                                                   3072.dat                                                                                            0000600 0004000 0002000 00000000141 14677744762 0014271 0                                                                                                    ustar 00postgres                        postgres                        0000000 0000000                                                                                                                                                                        27	Sindrome viral agudo	10	7	7
28	TENSIÓN ALTA CRISIS HIPERTENSIVA	10	7	8
29	Fatiga	10	9	9
\.


                                                                                                                                                                                                                                                                                                                                                                                                                               3074.dat                                                                                            0000600 0004000 0002000 00000000426 14677744762 0014301 0                                                                                                    ustar 00postgres                        postgres                        0000000 0000000                                                                                                                                                                        7	PERFIL 20	1	1	QUIMICA SANGUINIA
9	HEMOGRAMA COMPLETO	1	1	EVALUAR LA SALUD GENERAL DEL PACIENTE Y DETECTAR POSIBLES TRASTORNOS.
8	EVALUAR LA SALUD GENERAL DEL PACIENTE Y DETECTAR POSIBLES TRASTORNOS	0	1	EVALUAR LA SALUD GENERAL DEL PACIENTE Y DETECTAR POSIBLES TRASTORNOS
\.


                                                                                                                                                                                                                                          3076.dat                                                                                            0000600 0004000 0002000 00000000213 14677744762 0014275 0                                                                                                    ustar 00postgres                        postgres                        0000000 0000000                                                                                                                                                                        8	Acetaminofen	Acetaminofen	30 Pastillas de 500 Mg	13	20	24	5
9	Paracetamol	Alivia Malestar General	10 Pastillas de 650 Mg	14	21	25	5
\.


                                                                                                                                                                                                                                                                                                                                                                                     3080.dat                                                                                            0000600 0004000 0002000 00000001101 14677744762 0014265 0                                                                                                    ustar 00postgres                        postgres                        0000000 0000000                                                                                                                                                                        261	42	12	19
262	42	12	20
263	42	13	22
264	42	13	23
312	19	12	19
313	19	12	20
314	19	12	21
315	19	12	31
316	19	12	36
317	19	12	28
318	19	15	32
319	19	15	33
320	19	15	34
321	19	15	35
322	19	15	38
323	19	13	22
324	19	13	23
325	19	13	24
326	19	13	25
327	19	14	26
328	19	14	27
329	19	14	29
330	19	14	30
331	19	14	37
332	20	12	19
333	20	12	20
334	20	12	21
335	20	12	31
336	20	12	36
337	20	12	28
338	20	15	32
339	20	15	33
340	20	15	34
341	20	15	35
342	20	15	38
343	20	13	22
344	20	13	23
345	20	13	24
346	20	13	25
347	20	14	26
348	20	14	27
349	20	14	29
350	20	14	30
351	20	14	37
\.


                                                                                                                                                                                                                                                                                                                                                                                                                                                               3078.dat                                                                                            0000600 0004000 0002000 00000000427 14677744762 0014306 0                                                                                                    ustar 00postgres                        postgres                        0000000 0000000                                                                                                                                                                        12	Archivos	#Index.php	<i class= "fa-solid fa-archive me-2"></i>	1
15	Botica	#Index.php	<i class= "fa-solid fa-hospital me-2"></i>	2
13	Procesos	#Index.php	<i class= "fa-solid fa-folder-open me-2"></i>	3
14	Configuracion	#Index.php	<i class= "fa-solid fa-gears me-2"></i>	4
\.


                                                                                                                                                                                                                                         3082.dat                                                                                            0000600 0004000 0002000 00000000430 14677744762 0014273 0                                                                                                    ustar 00postgres                        postgres                        0000000 0000000                                                                                                                                                                        11	DIABETES MELLITUS	1	1	Es una enfermedad crónica que afecta la forma en que el cuerpo metaboliza la glucosa, lo que puede llevar a complicaciones serias si no se maneja adecuadamente.	0
10	SINDROME VIRAL AGUDO	0	2	ES UN CONJUNTO DE SÍNTOMAS QUE APARECEN REPENTINAMENTE	0
\.


                                                                                                                                                                                                                                        3084.dat                                                                                            0000600 0004000 0002000 00000002065 14677744762 0014303 0                                                                                                    ustar 00postgres                        postgres                        0000000 0000000                                                                                                                                                                        25	LUIS	MORENO	30420251	04245842882	DADDK2021@GMAIL.COM	1	URB. VISTA AL VALLE, CALLE 2, MANZANA 2, CASA N° 16	2002-08-03	1	DAVID	CASTILLO
26	BLAS	CASTILLO	19063494	04126786702	BLASCASTILLO444@GMAIL.COM	1	BARRIO ANTONIO JOSE DE SUCRE ENTRE AV 12 Y 9, FRENTE A CALLEJON EL RECREO	1986-10-01	1	ANTONIO	OJEDA
27	RICARDO	SANDOVAL	29881229	04148829496	RICARDOSANDOVALMARTINEZ1@GMAIL.COM	1	COCOROTE,LAS ACEQUIAS BLOQUE 5	2003-05-12	1	DANIEL	MARTINEZ
29	JESUS	BRAVO	7000000	04245715569	LUISDAVIDCASTILLO0867@GMAIL.COM	1	LA PRADERA, MANIZALES	2002-07-26	1	MIGUEL	CASTILLO
30	MIGUEL	SILVA	26943140	04120968206	MIGUEL_A_S_A@HOTMAIL.COM	1	URB. SAN ANTONIO	1998-08-10	1	ANGEL	ALVAREZ
31	GABRIEL	MARTINEZ	25687123	04128954235	GABRIELJOSE10@GAMIL.COM	1	COCOTOTE	1990-01-10	1	JOSE	LOPEZ
32	XAVIER	GOMEZ	1888888	04245580020	XAVIER@GMAIL.COM	1	SAN JOSE	1983-03-22	1	ALEXANDER	SAMBRANO
33	XAVIER	GOMEZ	16261904	04127811347	XAVIERGOMEZ2203@GMAIL.COM	1	SAN JOSE	1983-03-22	1	ALEXANDER	ZAMBRANO
34	JOHN	DOWN	12345678	04121234567	DAKAJUEGOS2022@HOTMAIL.COM	1	SAN FELIPE	2011-01-19	1	JOSE	DOBLE
\.


                                                                                                                                                                                                                                                                                                                                                                                                                                                                           3086.dat                                                                                            0000600 0004000 0002000 00000000272 14677744762 0014303 0                                                                                                    ustar 00postgres                        postgres                        0000000 0000000                                                                                                                                                                        2	Paracetamol por 3 días, una pastilla cada 8 horas	2024-07-19	9	27	2024-07-21
3	TOMAR MEDICAMENTOS	2024-07-19	9	28	2024-07-22
4	paracetamol cada 2 dias	2024-10-04	9	29	2024-10-06
\.


                                                                                                                                                                                                                                                                                                                                      3088.dat                                                                                            0000600 0004000 0002000 00000000223 14677744762 0014301 0                                                                                                    ustar 00postgres                        postgres                        0000000 0000000                                                                                                                                                                        9	reposo de 24 horas	2024-07-19	27	2024-07-20
10	REPOSO POR 72 HORAS	2024-07-19	28	2024-07-22
11	Reposo por 72 horas	2024-10-04	29	2024-10-06
\.


                                                                                                                                                                                                                                                                                                                                                                             3090.dat                                                                                            0000600 0004000 0002000 00000001406 14677744762 0014276 0                                                                                                    ustar 00postgres                        postgres                        0000000 0000000                                                                                                                                                                        17	MEDICO GENERAL	1	4	SE ENCARGA DE LOS PACIENTES QUE LLEGUEN AL LUGAR SIN NECESIDAD DE ACUDIR A EMERGENCIA               	9
16	ADMINISTRADOR DE SISTEMA	1	1	ADMINISTRADOR DEL SISTEMA.                                                                          	8
18	DOCTOR DE EMERGENCIA	1	4	ENCARGADO DE TODO PACIENTE QUE LLEGUE EN ESTADO DE EMERGENCIA, PARA SU RAPIDA ATENCION              	10
19	ENFERMERO(A)	1	5	SE ENCARGAN DE LLEVAR EL REGISTRO PRE CITA                                                          	11
20	ANALISTA DE PROCESOS	1	3	SE ENCARGA DE MANEJAR TODAS LAS CITAS Y LOS PROCESOS QUE CONLLEVAN A ELLOS HASTA SU FINALIZACION\r\n  	12
21	DIRECTOR	1	2	DIRECTOR                                                                                            	8
\.


                                                                                                                                                                                                                                                          3092.dat                                                                                            0000600 0004000 0002000 00000001300 14677744762 0014271 0                                                                                                    ustar 00postgres                        postgres                        0000000 0000000                                                                                                                                                                        1	16	12	19
2	16	12	20
3	16	12	21
4	16	12	31
5	16	12	36
6	16	12	28
7	16	13	22
8	16	13	23
9	16	13	24
10	16	13	25
11	16	14	26
12	16	14	27
13	16	14	29
14	16	14	30
15	16	14	37
16	16	15	32
17	16	15	33
18	16	15	34
19	16	15	35
20	16	15	38
21	17	12	19
22	17	13	22
23	17	13	24
24	17	13	25
25	17	15	38
26	18	12	19
27	18	13	22
28	18	13	24
29	18	13	25
30	18	15	38
31	19	12	19
32	19	13	22
33	19	13	23
34	20	12	19
35	20	12	21
36	20	12	31
37	20	13	22
38	20	13	23
39	20	13	25
40	20	14	37
41	20	15	32
42	20	15	33
43	20	15	34
44	20	15	35
45	20	15	38
46	21	12	19
47	21	12	20
48	21	12	21
49	21	12	31
50	21	12	36
51	21	12	28
52	21	13	22
53	21	13	23
54	21	13	24
55	21	13	25
56	21	14	26
57	21	14	27
58	21	14	37
59	21	15	38
\.


                                                                                                                                                                                                                                                                                                                                3094.dat                                                                                            0000600 0004000 0002000 00000000667 14677744762 0014312 0                                                                                                    ustar 00postgres                        postgres                        0000000 0000000                                                                                                                                                                        8	ADMINISTRATIVO	1	1	SERVICIO QUE LLEVA EL PERSONAL ADMINISTRATIVO.
10	EMERGENCIA	1	4	SERVICIO QUE ATIENDEN LOS MEDICOS DE EMERGANCIA
11	ENFERMERIA	1	5	SERVICIO QUE OFRECEN LOS ENFERMEROS Y LAS ENFERMERAS\r\n
9	MEDICINA GENERAL	1	4	SERVICIO DE MEDICINA GENERAL
13	MANTENIMIENTO	1	2	PERSONAL ENCARGADA DE LA LIMPIEZA DE LAS INSTALACIONES
12	CONTROL Y SEGUIMIENTO DE CITAS	0	3	SERVICIO QUE SE OCUPA DEL SEGUIMIENTO DEL PROCESO DE CITAS
\.


                                                                         3096.dat                                                                                            0000600 0004000 0002000 00000003405 14677744762 0014305 0                                                                                                    ustar 00postgres                        postgres                        0000000 0000000                                                                                                                                                                        19	12	Personas	PersonasIndex.php	<i class= "fa-solid fa-person ms-4 me-4"></i>	1
20	12	Usuarios	UsuariosIndex.php	<i class= "fa-solid fa-users ms-4 me-4"></i>	2
21	12	Patologia	PatologiasIndex.php	<i class= "fa-solid fa-virus ms-4 me-4"></i>	3
22	13	Citas	CitasIndex.php	<i class= "fa-solid fa-calendar ms-4 me-4"></i>	1
23	13	Citas Enfermeria	CitasEnfermeriaIndex.php	<i class= "fa-solid fa-calendar-plus ms-4 me-4"></i>	2
24	13	Citas Medico	CitasMedicoIndex.php	<i class= "fa-solid fa-droplet ms-4 me-4"></i>	3
26	14	Roles	RolesIndex.php	<i class= "fa-solid fa-user-gear ms-4 me-4"></i>	1
27	14	Asignaciones	AsignacionesIndex.php	<i class= "fa-solid fa-file-pen ms-4 me-4"></i>	2
25	13	Historias Medicas	HistoriasMedicasIndex.php	<i class= "fa-solid fa-calendar-days ms-4 me-4"></i>	4
29	14	Menus	MenusIndex.php	<i class= "fa-solid fa-layer-group ms-4 me-4"></i>	4
30	14	Sub Menus	SubmenusIndex.php	<i class= "fa-solid fa-list ms-4 me-4"></i>	5
31	12	Laboratorios	LaboratoriosIndex.php	<i class= "fa-solid fa-flask-vial ms-4 me-4"></i>	4
32	15	Componente Activo	ComponentesActivosIndex.php	<i class= "fa-solid fa-microscope ms-4 me-4"></i>	1
33	15	Tipo de Medicamento	Tipo_MedicamentosIndex.php	<i class= "fa-solid fa-pills ms-4 me-4"></i>	2
34	15	Unidad de Medida	UnidadMedidasIndex.php	<i class= "fa-solid fa-prescription-bottle ms-4 me-4"></i>	3
35	15	Unidad de Peso	UnidadPesosIndex.php	<i class= "fa-solid fa-capsules ms-4 me-4"></i>	4
36	12	Servicios	ServiciosIndex.php	<i class= "fa-solid fa-bookmark ms-4 me-4"></i>	5
37	14	Consultorios	ConsultoriosIndex.php	<i class= "fa-solid fa-house-medical ms-4 me-4"></i>	6
28	12	Cargos	CargosIndex.php	<i class= "fa-solid fa-pen-nib ms-4 me-4"></i>	6
38	15	Medicamentos	MedicamentosIndex.php	<i class= "fa-solid fa-syringe ms-4 me-4"></i>	5
\.


                                                                                                                                                                                                                                                           3098.dat                                                                                            0000600 0004000 0002000 00000000075 14677744763 0014310 0                                                                                                    ustar 00postgres                        postgres                        0000000 0000000                                                                                                                                                                        20	Analgesico	Analgesico
21	Antipirético	Antipirético
\.


                                                                                                                                                                                                                                                                                                                                                                                                                                                                   3100.dat                                                                                            0000600 0004000 0002000 00000000077 14677744763 0014272 0                                                                                                    ustar 00postgres                        postgres                        0000000 0000000                                                                                                                                                                        24	Tabletas	Tabletas
25	Capsulas Blandas	Capsulas Blandas
\.


                                                                                                                                                                                                                                                                                                                                                                                                                                                                 3102.dat                                                                                            0000600 0004000 0002000 00000000045 14677744763 0014267 0                                                                                                    ustar 00postgres                        postgres                        0000000 0000000                                                                                                                                                                        5	Miligramos	Mg
6	Mililitros	Ml
\.


                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           3104.dat                                                                                            0000600 0004000 0002000 00000001563 14677744763 0014277 0                                                                                                    ustar 00postgres                        postgres                        0000000 0000000                                                                                                                                                                        20	../vista/UsuariosFoto/user.jpg	$2y$10$3WLDP4SZsDCiBvB8490MzOKut4M8f6MKyQlr1QHb3RtCvM3FbG.Ui	16	26	8	1	\N
21	../vista/UsuariosFoto/user.jpg	$2y$10$Pro2ihbGacrp/6wtnzHc3eXiH.2fDQW.v12D3YdQWxOkA6/wzn8wG	16	27	8	0	\N
22	../vista/UsuariosFoto/user.jpg	$2y$10$8KqeKyz6DeKQ5FEDbU5uF.oXxKwYx9FYcMpD0Ab/CqCDAtRHZQ3UO	16	29	8	1	\N
23	../vista/UsuariosFoto/bam bam (1).jpg	$2y$10$qmT1jg6DB8H3twp5xPAnTu0chnrHeidb6CUCymgJQNlF0ZjXKWNLS	17	32	9	1	\N
28	../vista/UsuariosFoto/R (1).jpeg	$2y$10$HEmL0QT6nDyIYdbQ1LvaC.VD4RQlJVHFF/Z9AeORHOhwgwOgfG/e6	16	31	8	1	\N
29	../vista/UsuariosFoto/playa.jpeg	$2y$10$ZR1itIrCAn8KS8VRQ3O/0OAkR/0d0Y0420i7z5.PkCShyR4nRovCu	19	34	11	1	\N
42	../vista/UsuariosFoto/R (2).jpeg	$2y$10$oip0rFQzMNwlHc.G8IJ6cuWCrPQ5o9ak1e0PsZqFXyAI0hGg/ZFNi	16	33	8	1	\N
19	../vista/UsuariosFoto/user.jpg	$2y$10$imxfTpaQfntjTt9zcoaLnuTy7MyyLprXx/L7DzuOW8Oorf7n9oUnO	16	25	8	1	\N
\.


                                                                                                                                             restore.sql                                                                                         0000600 0004000 0002000 00000133130 14677744763 0015416 0                                                                                                    ustar 00postgres                        postgres                        0000000 0000000                                                                                                                                                                        --
-- NOTE:
--
-- File paths need to be edited. Search for $$PATH$$ and
-- replace it with the path to the directory containing
-- the extracted data files.
--
--
-- PostgreSQL database dump
--

-- Dumped from database version 12.18
-- Dumped by pg_dump version 12.18

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

DROP DATABASE climed;
--
-- Name: climed; Type: DATABASE; Schema: -; Owner: postgres
--

CREATE DATABASE climed WITH TEMPLATE = template0 ENCODING = 'UTF8' LC_COLLATE = 'Spanish_Venezuela.1252' LC_CTYPE = 'Spanish_Venezuela.1252';


ALTER DATABASE climed OWNER TO postgres;

\connect climed

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

--
-- Name: calcular_diferencia_minutos(time without time zone, time without time zone); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.calcular_diferencia_minutos(hora1 time without time zone, hora2 time without time zone) RETURNS integer
    LANGUAGE plpgsql
    AS $$
BEGIN
    RETURN EXTRACT(EPOCH FROM (hora2 - hora1)) / 60;
END;
$$;


ALTER FUNCTION public.calcular_diferencia_minutos(hora1 time without time zone, hora2 time without time zone) OWNER TO postgres;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- Name: asignaciones; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.asignaciones (
    id integer NOT NULL,
    nombre character varying(100) NOT NULL,
    estatus integer NOT NULL,
    descripcion character varying(100) NOT NULL,
    f_inicio date NOT NULL,
    f_fin date NOT NULL,
    fk_usuario integer NOT NULL,
    fk_servicios integer NOT NULL
);


ALTER TABLE public.asignaciones OWNER TO postgres;

--
-- Name: asignaciones_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.asignaciones_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.asignaciones_id_seq OWNER TO postgres;

--
-- Name: asignaciones_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.asignaciones_id_seq OWNED BY public.asignaciones.id;


--
-- Name: cargos; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.cargos (
    id integer NOT NULL,
    nombre character varying(80) NOT NULL,
    descripcion character varying(100),
    estatus smallint DEFAULT 1,
    fk_servicio integer,
    CONSTRAINT cargo_estatus_check CHECK ((estatus = ANY (ARRAY[0, 1])))
);


ALTER TABLE public.cargos OWNER TO postgres;

--
-- Name: cargo_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.cargo_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.cargo_id_seq OWNER TO postgres;

--
-- Name: cargo_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.cargo_id_seq OWNED BY public.cargos.id;


--
-- Name: citas; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.citas (
    id integer NOT NULL,
    fk_persona integer NOT NULL,
    fk_servicio integer NOT NULL,
    fk_usuario integer NOT NULL,
    fecha date NOT NULL,
    hora time without time zone NOT NULL,
    estatus integer NOT NULL,
    fk_usuario_sesion integer NOT NULL,
    fk_consultorio integer
);


ALTER TABLE public.citas OWNER TO postgres;

--
-- Name: citas_enfermeria; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.citas_enfermeria (
    id integer NOT NULL,
    altura character varying(80) NOT NULL,
    peso character varying(80) NOT NULL,
    tension character varying(80) NOT NULL,
    fk_cita integer
);


ALTER TABLE public.citas_enfermeria OWNER TO postgres;

--
-- Name: citas_enfermeria_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.citas_enfermeria_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.citas_enfermeria_id_seq OWNER TO postgres;

--
-- Name: citas_enfermeria_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.citas_enfermeria_id_seq OWNED BY public.citas_enfermeria.id;


--
-- Name: citas_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.citas_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.citas_id_seq OWNER TO postgres;

--
-- Name: citas_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.citas_id_seq OWNED BY public.citas.id;


--
-- Name: componentesactivos; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.componentesactivos (
    id integer NOT NULL,
    nombre character varying(140),
    descripcion character varying(140)
);


ALTER TABLE public.componentesactivos OWNER TO postgres;

--
-- Name: componentesactivos_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.componentesactivos_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.componentesactivos_id_seq OWNER TO postgres;

--
-- Name: componentesactivos_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.componentesactivos_id_seq OWNED BY public.componentesactivos.id;


--
-- Name: consultorios; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.consultorios (
    id integer NOT NULL,
    nombre character varying(100),
    descripcion character varying(100),
    estatus smallint
);


ALTER TABLE public.consultorios OWNER TO postgres;

--
-- Name: consultorios_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.consultorios_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.consultorios_id_seq OWNER TO postgres;

--
-- Name: consultorios_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.consultorios_id_seq OWNED BY public.consultorios.id;


--
-- Name: historias_medicas; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.historias_medicas (
    id integer NOT NULL,
    diagnostico character varying(400) NOT NULL,
    fk_patologia integer,
    fk_laboratorio integer,
    fk_cita_enfermeria integer
);


ALTER TABLE public.historias_medicas OWNER TO postgres;

--
-- Name: historias_medicas_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.historias_medicas_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.historias_medicas_id_seq OWNER TO postgres;

--
-- Name: historias_medicas_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.historias_medicas_id_seq OWNED BY public.historias_medicas.id;


--
-- Name: laboratorios; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.laboratorios (
    id integer NOT NULL,
    nombre character varying(100),
    estatus integer,
    valor integer,
    descripcion character varying(100)
);


ALTER TABLE public.laboratorios OWNER TO postgres;

--
-- Name: laboratorios_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.laboratorios_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.laboratorios_id_seq OWNER TO postgres;

--
-- Name: laboratorios_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.laboratorios_id_seq OWNED BY public.laboratorios.id;


--
-- Name: medicamentos; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.medicamentos (
    id integer NOT NULL,
    nombre_comercial character varying(400) NOT NULL,
    descripcion character varying(400) NOT NULL,
    cantidad character varying(400) NOT NULL,
    fk_componentesactivos integer,
    fk_tipo_medicamento integer NOT NULL,
    fk_unidadmedida integer NOT NULL,
    fk_unidadpeso integer NOT NULL
);


ALTER TABLE public.medicamentos OWNER TO postgres;

--
-- Name: medicamentos_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.medicamentos_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.medicamentos_id_seq OWNER TO postgres;

--
-- Name: medicamentos_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.medicamentos_id_seq OWNED BY public.medicamentos.id;


--
-- Name: menus; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.menus (
    id integer NOT NULL,
    nombre character varying(100),
    url character varying(100),
    icono character varying(100),
    orden integer
);


ALTER TABLE public.menus OWNER TO postgres;

--
-- Name: menu_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.menu_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.menu_id_seq OWNER TO postgres;

--
-- Name: menu_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.menu_id_seq OWNED BY public.menus.id;


--
-- Name: menu_usuario; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.menu_usuario (
    id integer NOT NULL,
    fk_usuario integer NOT NULL,
    fk_menu integer NOT NULL,
    fk_submenu integer NOT NULL
);


ALTER TABLE public.menu_usuario OWNER TO postgres;

--
-- Name: menu_usuario_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.menu_usuario_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.menu_usuario_id_seq OWNER TO postgres;

--
-- Name: menu_usuario_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.menu_usuario_id_seq OWNED BY public.menu_usuario.id;


--
-- Name: patologias; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.patologias (
    id integer NOT NULL,
    nombre character varying(100) NOT NULL,
    estatus integer NOT NULL,
    valor integer NOT NULL,
    descripcion character varying(800) NOT NULL,
    alerta integer NOT NULL
);


ALTER TABLE public.patologias OWNER TO postgres;

--
-- Name: patologias_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.patologias_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.patologias_id_seq OWNER TO postgres;

--
-- Name: patologias_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.patologias_id_seq OWNED BY public.patologias.id;


--
-- Name: personas; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.personas (
    id integer NOT NULL,
    nombre character varying(100) NOT NULL,
    apellido character varying(100) NOT NULL,
    cedula character varying(9) NOT NULL,
    telefono character varying(12) NOT NULL,
    correo character varying(100) NOT NULL,
    sexo integer NOT NULL,
    direccion character varying(100) NOT NULL,
    f_nacimiento date NOT NULL,
    estatus character varying(20),
    segundo_nombre character varying(80) DEFAULT 'Sin segundo nombre'::character varying NOT NULL,
    segundo_apellido character varying(80) DEFAULT 'Sin segundo apellido'::character varying NOT NULL
);


ALTER TABLE public.personas OWNER TO postgres;

--
-- Name: personas_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.personas_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.personas_id_seq OWNER TO postgres;

--
-- Name: personas_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.personas_id_seq OWNED BY public.personas.id;


--
-- Name: recipes; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.recipes (
    id integer NOT NULL,
    receta character varying(400) NOT NULL,
    f_inicio date NOT NULL,
    fk_medicamento integer,
    fk_historia_medica integer,
    f_fin date NOT NULL
);


ALTER TABLE public.recipes OWNER TO postgres;

--
-- Name: recipes_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.recipes_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.recipes_id_seq OWNER TO postgres;

--
-- Name: recipes_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.recipes_id_seq OWNED BY public.recipes.id;


--
-- Name: reposo; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.reposo (
    id integer NOT NULL,
    descripcion character varying(400) NOT NULL,
    f_inicio date NOT NULL,
    fk_historia_medica integer,
    f_fin date NOT NULL
);


ALTER TABLE public.reposo OWNER TO postgres;

--
-- Name: reposo_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.reposo_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.reposo_id_seq OWNER TO postgres;

--
-- Name: reposo_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.reposo_id_seq OWNED BY public.reposo.id;


--
-- Name: roles; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.roles (
    id integer NOT NULL,
    nombre character varying(100) NOT NULL,
    estatus integer NOT NULL,
    valor integer NOT NULL,
    descripcion character(100) NOT NULL,
    fk_cargo integer
);


ALTER TABLE public.roles OWNER TO postgres;

--
-- Name: roles_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.roles_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.roles_id_seq OWNER TO postgres;

--
-- Name: roles_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.roles_id_seq OWNED BY public.roles.id;


--
-- Name: roles_menu; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.roles_menu (
    id integer NOT NULL,
    fk_rol integer,
    fk_menu integer,
    fk_submenu integer
);


ALTER TABLE public.roles_menu OWNER TO postgres;

--
-- Name: roles_menu_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.roles_menu_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.roles_menu_id_seq OWNER TO postgres;

--
-- Name: roles_menu_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.roles_menu_id_seq OWNED BY public.roles_menu.id;


--
-- Name: servicios; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.servicios (
    id integer NOT NULL,
    nombre character varying(100) NOT NULL,
    estatus integer NOT NULL,
    valor integer NOT NULL,
    descripcion character varying(100) NOT NULL
);


ALTER TABLE public.servicios OWNER TO postgres;

--
-- Name: servicios_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.servicios_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.servicios_id_seq OWNER TO postgres;

--
-- Name: servicios_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.servicios_id_seq OWNED BY public.servicios.id;


--
-- Name: submenus; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.submenus (
    id integer NOT NULL,
    fk_menus integer,
    nombre character varying(50),
    url character varying(100),
    icono character varying(300),
    orden integer
);


ALTER TABLE public.submenus OWNER TO postgres;

--
-- Name: submenu_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.submenu_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.submenu_id_seq OWNER TO postgres;

--
-- Name: submenu_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.submenu_id_seq OWNED BY public.submenus.id;


--
-- Name: tipo_medicamentos; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.tipo_medicamentos (
    id integer NOT NULL,
    nombre character varying(400) NOT NULL,
    descripcion character varying(400) NOT NULL
);


ALTER TABLE public.tipo_medicamentos OWNER TO postgres;

--
-- Name: tipo_medicamentos_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.tipo_medicamentos_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tipo_medicamentos_id_seq OWNER TO postgres;

--
-- Name: tipo_medicamentos_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.tipo_medicamentos_id_seq OWNED BY public.tipo_medicamentos.id;


--
-- Name: unidadmedida; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.unidadmedida (
    id integer NOT NULL,
    nombre character varying(140),
    descripcion character varying(140)
);


ALTER TABLE public.unidadmedida OWNER TO postgres;

--
-- Name: unidadmedida_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.unidadmedida_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.unidadmedida_id_seq OWNER TO postgres;

--
-- Name: unidadmedida_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.unidadmedida_id_seq OWNED BY public.unidadmedida.id;


--
-- Name: unidadpeso; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.unidadpeso (
    id integer NOT NULL,
    nombre character varying(140),
    descripcion character varying(140)
);


ALTER TABLE public.unidadpeso OWNER TO postgres;

--
-- Name: unidadpeso_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.unidadpeso_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.unidadpeso_id_seq OWNER TO postgres;

--
-- Name: unidadpeso_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.unidadpeso_id_seq OWNED BY public.unidadpeso.id;


--
-- Name: usuarios; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.usuarios (
    id integer NOT NULL,
    foto character varying(100) NOT NULL,
    clave character varying(100) NOT NULL,
    fk_rol integer NOT NULL,
    fk_persona integer NOT NULL,
    fk_servicio integer NOT NULL,
    estatus integer,
    cedula character varying
);


ALTER TABLE public.usuarios OWNER TO postgres;

--
-- Name: usuario_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.usuario_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.usuario_id_seq OWNER TO postgres;

--
-- Name: usuario_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.usuario_id_seq OWNED BY public.usuarios.id;


--
-- Name: asignaciones id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.asignaciones ALTER COLUMN id SET DEFAULT nextval('public.asignaciones_id_seq'::regclass);


--
-- Name: cargos id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.cargos ALTER COLUMN id SET DEFAULT nextval('public.cargo_id_seq'::regclass);


--
-- Name: citas id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.citas ALTER COLUMN id SET DEFAULT nextval('public.citas_id_seq'::regclass);


--
-- Name: citas_enfermeria id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.citas_enfermeria ALTER COLUMN id SET DEFAULT nextval('public.citas_enfermeria_id_seq'::regclass);


--
-- Name: componentesactivos id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.componentesactivos ALTER COLUMN id SET DEFAULT nextval('public.componentesactivos_id_seq'::regclass);


--
-- Name: consultorios id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.consultorios ALTER COLUMN id SET DEFAULT nextval('public.consultorios_id_seq'::regclass);


--
-- Name: historias_medicas id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.historias_medicas ALTER COLUMN id SET DEFAULT nextval('public.historias_medicas_id_seq'::regclass);


--
-- Name: laboratorios id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.laboratorios ALTER COLUMN id SET DEFAULT nextval('public.laboratorios_id_seq'::regclass);


--
-- Name: medicamentos id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.medicamentos ALTER COLUMN id SET DEFAULT nextval('public.medicamentos_id_seq'::regclass);


--
-- Name: menu_usuario id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.menu_usuario ALTER COLUMN id SET DEFAULT nextval('public.menu_usuario_id_seq'::regclass);


--
-- Name: menus id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.menus ALTER COLUMN id SET DEFAULT nextval('public.menu_id_seq'::regclass);


--
-- Name: patologias id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.patologias ALTER COLUMN id SET DEFAULT nextval('public.patologias_id_seq'::regclass);


--
-- Name: personas id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.personas ALTER COLUMN id SET DEFAULT nextval('public.personas_id_seq'::regclass);


--
-- Name: recipes id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.recipes ALTER COLUMN id SET DEFAULT nextval('public.recipes_id_seq'::regclass);


--
-- Name: reposo id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.reposo ALTER COLUMN id SET DEFAULT nextval('public.reposo_id_seq'::regclass);


--
-- Name: roles id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.roles ALTER COLUMN id SET DEFAULT nextval('public.roles_id_seq'::regclass);


--
-- Name: roles_menu id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.roles_menu ALTER COLUMN id SET DEFAULT nextval('public.roles_menu_id_seq'::regclass);


--
-- Name: servicios id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.servicios ALTER COLUMN id SET DEFAULT nextval('public.servicios_id_seq'::regclass);


--
-- Name: submenus id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.submenus ALTER COLUMN id SET DEFAULT nextval('public.submenu_id_seq'::regclass);


--
-- Name: tipo_medicamentos id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tipo_medicamentos ALTER COLUMN id SET DEFAULT nextval('public.tipo_medicamentos_id_seq'::regclass);


--
-- Name: unidadmedida id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.unidadmedida ALTER COLUMN id SET DEFAULT nextval('public.unidadmedida_id_seq'::regclass);


--
-- Name: unidadpeso id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.unidadpeso ALTER COLUMN id SET DEFAULT nextval('public.unidadpeso_id_seq'::regclass);


--
-- Name: usuarios id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.usuarios ALTER COLUMN id SET DEFAULT nextval('public.usuario_id_seq'::regclass);


--
-- Data for Name: asignaciones; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.asignaciones (id, nombre, estatus, descripcion, f_inicio, f_fin, fk_usuario, fk_servicios) FROM stdin;
\.
COPY public.asignaciones (id, nombre, estatus, descripcion, f_inicio, f_fin, fk_usuario, fk_servicios) FROM '$$PATH$$/3060.dat';

--
-- Data for Name: cargos; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.cargos (id, nombre, descripcion, estatus, fk_servicio) FROM stdin;
\.
COPY public.cargos (id, nombre, descripcion, estatus, fk_servicio) FROM '$$PATH$$/3062.dat';

--
-- Data for Name: citas; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.citas (id, fk_persona, fk_servicio, fk_usuario, fecha, hora, estatus, fk_usuario_sesion, fk_consultorio) FROM stdin;
\.
COPY public.citas (id, fk_persona, fk_servicio, fk_usuario, fecha, hora, estatus, fk_usuario_sesion, fk_consultorio) FROM '$$PATH$$/3064.dat';

--
-- Data for Name: citas_enfermeria; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.citas_enfermeria (id, altura, peso, tension, fk_cita) FROM stdin;
\.
COPY public.citas_enfermeria (id, altura, peso, tension, fk_cita) FROM '$$PATH$$/3065.dat';

--
-- Data for Name: componentesactivos; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.componentesactivos (id, nombre, descripcion) FROM stdin;
\.
COPY public.componentesactivos (id, nombre, descripcion) FROM '$$PATH$$/3068.dat';

--
-- Data for Name: consultorios; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.consultorios (id, nombre, descripcion, estatus) FROM stdin;
\.
COPY public.consultorios (id, nombre, descripcion, estatus) FROM '$$PATH$$/3070.dat';

--
-- Data for Name: historias_medicas; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.historias_medicas (id, diagnostico, fk_patologia, fk_laboratorio, fk_cita_enfermeria) FROM stdin;
\.
COPY public.historias_medicas (id, diagnostico, fk_patologia, fk_laboratorio, fk_cita_enfermeria) FROM '$$PATH$$/3072.dat';

--
-- Data for Name: laboratorios; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.laboratorios (id, nombre, estatus, valor, descripcion) FROM stdin;
\.
COPY public.laboratorios (id, nombre, estatus, valor, descripcion) FROM '$$PATH$$/3074.dat';

--
-- Data for Name: medicamentos; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.medicamentos (id, nombre_comercial, descripcion, cantidad, fk_componentesactivos, fk_tipo_medicamento, fk_unidadmedida, fk_unidadpeso) FROM stdin;
\.
COPY public.medicamentos (id, nombre_comercial, descripcion, cantidad, fk_componentesactivos, fk_tipo_medicamento, fk_unidadmedida, fk_unidadpeso) FROM '$$PATH$$/3076.dat';

--
-- Data for Name: menu_usuario; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.menu_usuario (id, fk_usuario, fk_menu, fk_submenu) FROM stdin;
\.
COPY public.menu_usuario (id, fk_usuario, fk_menu, fk_submenu) FROM '$$PATH$$/3080.dat';

--
-- Data for Name: menus; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.menus (id, nombre, url, icono, orden) FROM stdin;
\.
COPY public.menus (id, nombre, url, icono, orden) FROM '$$PATH$$/3078.dat';

--
-- Data for Name: patologias; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.patologias (id, nombre, estatus, valor, descripcion, alerta) FROM stdin;
\.
COPY public.patologias (id, nombre, estatus, valor, descripcion, alerta) FROM '$$PATH$$/3082.dat';

--
-- Data for Name: personas; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.personas (id, nombre, apellido, cedula, telefono, correo, sexo, direccion, f_nacimiento, estatus, segundo_nombre, segundo_apellido) FROM stdin;
\.
COPY public.personas (id, nombre, apellido, cedula, telefono, correo, sexo, direccion, f_nacimiento, estatus, segundo_nombre, segundo_apellido) FROM '$$PATH$$/3084.dat';

--
-- Data for Name: recipes; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.recipes (id, receta, f_inicio, fk_medicamento, fk_historia_medica, f_fin) FROM stdin;
\.
COPY public.recipes (id, receta, f_inicio, fk_medicamento, fk_historia_medica, f_fin) FROM '$$PATH$$/3086.dat';

--
-- Data for Name: reposo; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.reposo (id, descripcion, f_inicio, fk_historia_medica, f_fin) FROM stdin;
\.
COPY public.reposo (id, descripcion, f_inicio, fk_historia_medica, f_fin) FROM '$$PATH$$/3088.dat';

--
-- Data for Name: roles; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.roles (id, nombre, estatus, valor, descripcion, fk_cargo) FROM stdin;
\.
COPY public.roles (id, nombre, estatus, valor, descripcion, fk_cargo) FROM '$$PATH$$/3090.dat';

--
-- Data for Name: roles_menu; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.roles_menu (id, fk_rol, fk_menu, fk_submenu) FROM stdin;
\.
COPY public.roles_menu (id, fk_rol, fk_menu, fk_submenu) FROM '$$PATH$$/3092.dat';

--
-- Data for Name: servicios; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.servicios (id, nombre, estatus, valor, descripcion) FROM stdin;
\.
COPY public.servicios (id, nombre, estatus, valor, descripcion) FROM '$$PATH$$/3094.dat';

--
-- Data for Name: submenus; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.submenus (id, fk_menus, nombre, url, icono, orden) FROM stdin;
\.
COPY public.submenus (id, fk_menus, nombre, url, icono, orden) FROM '$$PATH$$/3096.dat';

--
-- Data for Name: tipo_medicamentos; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.tipo_medicamentos (id, nombre, descripcion) FROM stdin;
\.
COPY public.tipo_medicamentos (id, nombre, descripcion) FROM '$$PATH$$/3098.dat';

--
-- Data for Name: unidadmedida; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.unidadmedida (id, nombre, descripcion) FROM stdin;
\.
COPY public.unidadmedida (id, nombre, descripcion) FROM '$$PATH$$/3100.dat';

--
-- Data for Name: unidadpeso; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.unidadpeso (id, nombre, descripcion) FROM stdin;
\.
COPY public.unidadpeso (id, nombre, descripcion) FROM '$$PATH$$/3102.dat';

--
-- Data for Name: usuarios; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.usuarios (id, foto, clave, fk_rol, fk_persona, fk_servicio, estatus, cedula) FROM stdin;
\.
COPY public.usuarios (id, foto, clave, fk_rol, fk_persona, fk_servicio, estatus, cedula) FROM '$$PATH$$/3104.dat';

--
-- Name: asignaciones_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.asignaciones_id_seq', 4, true);


--
-- Name: cargo_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.cargo_id_seq', 13, true);


--
-- Name: citas_enfermeria_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.citas_enfermeria_id_seq', 9, true);


--
-- Name: citas_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.citas_id_seq', 39, true);


--
-- Name: componentesactivos_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.componentesactivos_id_seq', 14, true);


--
-- Name: consultorios_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.consultorios_id_seq', 4, true);


--
-- Name: historias_medicas_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.historias_medicas_id_seq', 29, true);


--
-- Name: laboratorios_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.laboratorios_id_seq', 9, true);


--
-- Name: medicamentos_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.medicamentos_id_seq', 9, true);


--
-- Name: menu_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.menu_id_seq', 15, true);


--
-- Name: menu_usuario_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.menu_usuario_id_seq', 351, true);


--
-- Name: patologias_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.patologias_id_seq', 11, true);


--
-- Name: personas_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.personas_id_seq', 35, true);


--
-- Name: recipes_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.recipes_id_seq', 4, true);


--
-- Name: reposo_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.reposo_id_seq', 11, true);


--
-- Name: roles_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.roles_id_seq', 21, true);


--
-- Name: roles_menu_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.roles_menu_id_seq', 59, true);


--
-- Name: servicios_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.servicios_id_seq', 13, true);


--
-- Name: submenu_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.submenu_id_seq', 38, true);


--
-- Name: tipo_medicamentos_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.tipo_medicamentos_id_seq', 21, true);


--
-- Name: unidadmedida_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.unidadmedida_id_seq', 25, true);


--
-- Name: unidadpeso_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.unidadpeso_id_seq', 6, true);


--
-- Name: usuario_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.usuario_id_seq', 42, true);


--
-- Name: asignaciones asignaciones_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.asignaciones
    ADD CONSTRAINT asignaciones_pkey PRIMARY KEY (id);


--
-- Name: cargos cargo_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.cargos
    ADD CONSTRAINT cargo_pkey PRIMARY KEY (id);


--
-- Name: personas cedula_unico; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.personas
    ADD CONSTRAINT cedula_unico UNIQUE (cedula);


--
-- Name: citas_enfermeria citas_enfermeria_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.citas_enfermeria
    ADD CONSTRAINT citas_enfermeria_pkey PRIMARY KEY (id);


--
-- Name: citas citas_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.citas
    ADD CONSTRAINT citas_pkey PRIMARY KEY (id);


--
-- Name: componentesactivos componentesactivos_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.componentesactivos
    ADD CONSTRAINT componentesactivos_pkey PRIMARY KEY (id);


--
-- Name: consultorios consultorios_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.consultorios
    ADD CONSTRAINT consultorios_pkey PRIMARY KEY (id);


--
-- Name: historias_medicas historias_medicas_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.historias_medicas
    ADD CONSTRAINT historias_medicas_pkey PRIMARY KEY (id);


--
-- Name: laboratorios laboratorios_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.laboratorios
    ADD CONSTRAINT laboratorios_pkey PRIMARY KEY (id);


--
-- Name: medicamentos medicamentos_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.medicamentos
    ADD CONSTRAINT medicamentos_pkey PRIMARY KEY (id);


--
-- Name: menus menu_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.menus
    ADD CONSTRAINT menu_pkey PRIMARY KEY (id);


--
-- Name: menu_usuario menu_usuario_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.menu_usuario
    ADD CONSTRAINT menu_usuario_pkey PRIMARY KEY (id);


--
-- Name: patologias patologias_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.patologias
    ADD CONSTRAINT patologias_pkey PRIMARY KEY (id);


--
-- Name: personas personas_cedula_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.personas
    ADD CONSTRAINT personas_cedula_key UNIQUE (cedula);


--
-- Name: personas personas_correo_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.personas
    ADD CONSTRAINT personas_correo_key UNIQUE (correo);


--
-- Name: personas personas_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.personas
    ADD CONSTRAINT personas_pkey PRIMARY KEY (id);


--
-- Name: recipes recipes_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.recipes
    ADD CONSTRAINT recipes_pkey PRIMARY KEY (id);


--
-- Name: reposo reposo_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.reposo
    ADD CONSTRAINT reposo_pkey PRIMARY KEY (id);


--
-- Name: roles_menu roles_menu_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.roles_menu
    ADD CONSTRAINT roles_menu_pkey PRIMARY KEY (id);


--
-- Name: roles roles_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.roles
    ADD CONSTRAINT roles_pkey PRIMARY KEY (id);


--
-- Name: servicios servicios_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.servicios
    ADD CONSTRAINT servicios_pkey PRIMARY KEY (id);


--
-- Name: submenus submenu_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.submenus
    ADD CONSTRAINT submenu_pkey PRIMARY KEY (id);


--
-- Name: tipo_medicamentos tipo_medicamentos_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tipo_medicamentos
    ADD CONSTRAINT tipo_medicamentos_pkey PRIMARY KEY (id);


--
-- Name: unidadmedida unidadmedida_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.unidadmedida
    ADD CONSTRAINT unidadmedida_pkey PRIMARY KEY (id);


--
-- Name: unidadpeso unidadpeso_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.unidadpeso
    ADD CONSTRAINT unidadpeso_pkey PRIMARY KEY (id);


--
-- Name: personas unique_cedula; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.personas
    ADD CONSTRAINT unique_cedula UNIQUE (cedula);


--
-- Name: usuarios usuario_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.usuarios
    ADD CONSTRAINT usuario_pkey PRIMARY KEY (id);


--
-- Name: citas_enfermeria citas_enfermeria_fk_cita_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.citas_enfermeria
    ADD CONSTRAINT citas_enfermeria_fk_cita_fkey FOREIGN KEY (fk_cita) REFERENCES public.citas(id);


--
-- Name: asignaciones fk_asignaciones_servicios; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.asignaciones
    ADD CONSTRAINT fk_asignaciones_servicios FOREIGN KEY (fk_servicios) REFERENCES public.servicios(id);


--
-- Name: roles fk_cargo; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.roles
    ADD CONSTRAINT fk_cargo FOREIGN KEY (fk_cargo) REFERENCES public.cargos(id);


--
-- Name: medicamentos fk_componentesactivos; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.medicamentos
    ADD CONSTRAINT fk_componentesactivos FOREIGN KEY (fk_componentesactivos) REFERENCES public.componentesactivos(id);


--
-- Name: citas fk_consultorio; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.citas
    ADD CONSTRAINT fk_consultorio FOREIGN KEY (fk_consultorio) REFERENCES public.consultorios(id);


--
-- Name: citas fk_persona; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.citas
    ADD CONSTRAINT fk_persona FOREIGN KEY (fk_persona) REFERENCES public.personas(id);


--
-- Name: citas fk_servicio; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.citas
    ADD CONSTRAINT fk_servicio FOREIGN KEY (fk_servicio) REFERENCES public.servicios(id);


--
-- Name: cargos fk_servicio; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.cargos
    ADD CONSTRAINT fk_servicio FOREIGN KEY (fk_servicio) REFERENCES public.servicios(id);


--
-- Name: medicamentos fk_tipo_medicamento; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.medicamentos
    ADD CONSTRAINT fk_tipo_medicamento FOREIGN KEY (fk_tipo_medicamento) REFERENCES public.tipo_medicamentos(id);


--
-- Name: medicamentos fk_unidadmedida; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.medicamentos
    ADD CONSTRAINT fk_unidadmedida FOREIGN KEY (fk_unidadmedida) REFERENCES public.unidadmedida(id);


--
-- Name: medicamentos fk_unidadpeso; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.medicamentos
    ADD CONSTRAINT fk_unidadpeso FOREIGN KEY (fk_unidadpeso) REFERENCES public.unidadpeso(id);


--
-- Name: citas fk_usuario; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.citas
    ADD CONSTRAINT fk_usuario FOREIGN KEY (fk_usuario) REFERENCES public.usuarios(id);


--
-- Name: usuarios fk_usuario_persona; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.usuarios
    ADD CONSTRAINT fk_usuario_persona FOREIGN KEY (fk_persona) REFERENCES public.personas(id) ON DELETE CASCADE;


--
-- Name: usuarios fk_usuario_servicio; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.usuarios
    ADD CONSTRAINT fk_usuario_servicio FOREIGN KEY (fk_servicio) REFERENCES public.servicios(id) ON DELETE CASCADE;


--
-- Name: historias_medicas historias_medicas_fk_cita_enfermeria_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.historias_medicas
    ADD CONSTRAINT historias_medicas_fk_cita_enfermeria_fkey FOREIGN KEY (fk_cita_enfermeria) REFERENCES public.citas_enfermeria(id);


--
-- Name: historias_medicas historias_medicas_fk_laboratorio_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.historias_medicas
    ADD CONSTRAINT historias_medicas_fk_laboratorio_fkey FOREIGN KEY (fk_laboratorio) REFERENCES public.laboratorios(id);


--
-- Name: historias_medicas historias_medicas_fk_patologia_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.historias_medicas
    ADD CONSTRAINT historias_medicas_fk_patologia_fkey FOREIGN KEY (fk_patologia) REFERENCES public.patologias(id) NOT VALID;


--
-- Name: menu_usuario menu_usuario_fk_menu_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.menu_usuario
    ADD CONSTRAINT menu_usuario_fk_menu_fkey FOREIGN KEY (fk_menu) REFERENCES public.menus(id) NOT VALID;


--
-- Name: menu_usuario menu_usuario_fk_submenu_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.menu_usuario
    ADD CONSTRAINT menu_usuario_fk_submenu_fkey FOREIGN KEY (fk_submenu) REFERENCES public.submenus(id) NOT VALID;


--
-- Name: menu_usuario menu_usuario_fk_usuario_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.menu_usuario
    ADD CONSTRAINT menu_usuario_fk_usuario_fkey FOREIGN KEY (fk_usuario) REFERENCES public.usuarios(id) NOT VALID;


--
-- Name: recipes recipes_fk_historia_medica_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.recipes
    ADD CONSTRAINT recipes_fk_historia_medica_fkey FOREIGN KEY (fk_historia_medica) REFERENCES public.historias_medicas(id);


--
-- Name: recipes recipes_fk_medicamento_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.recipes
    ADD CONSTRAINT recipes_fk_medicamento_fkey FOREIGN KEY (fk_medicamento) REFERENCES public.medicamentos(id) NOT VALID;


--
-- Name: reposo reposo_fk_historia_medica_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.reposo
    ADD CONSTRAINT reposo_fk_historia_medica_fkey FOREIGN KEY (fk_historia_medica) REFERENCES public.historias_medicas(id);


--
-- Name: roles_menu roles_menu_fk_menu_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.roles_menu
    ADD CONSTRAINT roles_menu_fk_menu_fkey FOREIGN KEY (fk_menu) REFERENCES public.menus(id) ON UPDATE CASCADE ON DELETE CASCADE NOT VALID;


--
-- Name: roles_menu roles_menu_fk_rol_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.roles_menu
    ADD CONSTRAINT roles_menu_fk_rol_fkey FOREIGN KEY (fk_rol) REFERENCES public.roles(id) ON UPDATE CASCADE ON DELETE CASCADE NOT VALID;


--
-- Name: roles_menu roles_menu_fk_submenu_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.roles_menu
    ADD CONSTRAINT roles_menu_fk_submenu_fkey FOREIGN KEY (fk_submenu) REFERENCES public.submenus(id) ON UPDATE CASCADE ON DELETE CASCADE NOT VALID;


--
-- Name: submenus submenu_fk_menu_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.submenus
    ADD CONSTRAINT submenu_fk_menu_fkey FOREIGN KEY (fk_menus) REFERENCES public.menus(id);


--
-- Name: usuarios usuarios_fk_rol_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.usuarios
    ADD CONSTRAINT usuarios_fk_rol_fkey FOREIGN KEY (fk_rol) REFERENCES public.roles(id) ON UPDATE CASCADE ON DELETE CASCADE NOT VALID;


--
-- PostgreSQL database dump complete
--

                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        