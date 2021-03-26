<?php
namespace MuseumCore\Register;

use MuseumCore\Register\PostType;
use MuseumCore\Register\Registry;
use MuseumCore\Util\Inflector;

/**
 * Taxonomy
 *
 * API for http://codex.wordpress.org/Function_Reference/register_taxonomy
 */
class Taxonomy extends Registerable
{
    use Resourceful;

    protected $singular = '';
    protected $postTypes = [];
    protected $form = [];
    protected $resource = null;
    protected $existing = null;
    protected $hooksAttached = false;

    /**
     * Make Taxonomy. Do not use before init.
     *
     * @param string $singular singular name is required
     * @param string $plural plural name
     * @param array $settings args override and extend
     */
    public function __construct( $singular, $plural = null, $settings = [])
    {
        $this->singular = $singular;
        $lowerSingular = strtolower( trim($singular) );

        if (! $plural) {
            $plural = Inflector::pluralize($singular);
            $existing = get_taxonomy( strtolower($lowerSingular) );

            if($existing) {
                $this->existing = $existing;

                $singular = str_replace(' ', '_', $singular );
                $plural  = str_replace(' ', '_', $plural );

                $this->id = $this->existing->name;
                $this->resource = Registry::getTaxonomyResource($this->id) ?? [$singular, $plural, null, null];
                $this->postTypes = $this->existing->object_type;
                $this->args = array_merge($this->args, (array) $this->existing, $settings);

                return $this;
            }
        }

        $this->applyQuickLabels($singular, $plural);

        if (array_key_exists( 'hierarchical', $settings ) && $settings['hierarchical'] === true) :
            $settings['hierarchical'] = true;
        else :
            $settings['hierarchical'] = false;
        endif;

        // setup object for later use
        $plural       = str_replace(' ', '_', $plural );
        $singular     = str_replace(' ', '_', $singular );
        $this->resource = [$singular, $plural, $this->modelClass, $this->controllerClass];
        $this->id     = ! $this->id ? $singular : $this->id;

        if (array_key_exists( 'capabilities', $settings ) && $settings['capabilities'] === true) :
            $settings['capabilities'] = [
                'manage_terms' => 'manage_' . $plural,
                'edit_terms'   => 'manage_' . $plural,
                'delete_terms' => 'manage_' . $plural,
                'assign_terms' => 'edit_posts',
            ];
        endif;

        $defaults = [
            'show_admin_column' => true,
            'rewrite'           => ['slug' => sanitize_title( $this->id )],
        ];

        $this->args = array_merge( $this->args, $defaults, $settings );

        return $this;
    }

    /**
     * Apply Quick Labels
     *
     * @param string $singular
     * @param string $plural
     * @param bool $keep_case
     * @return Taxonomy $this
     */
    public function applyQuickLabels($singular, $plural = null, $keep_case = false)
    {
        if(!$plural) { $plural = Inflector::pluralize($singular); }

        // make lowercase
        $upperSingular = $keep_case ? $singular :  mb_convert_case($singular, MB_CASE_TITLE, "UTF-8");
        $upperPlural   = $keep_case ? $plural  : mb_convert_case($plural, MB_CASE_TITLE, "UTF-8");
        $lowerPlural   = $keep_case ? $plural : mb_strtolower( $plural );

        $labels = [
            'add_new_item'               => __( 'Add New ' . $upperSingular, 'museum-core'),
            'add_or_remove_items'        => __( 'Add or remove ' . $lowerPlural, 'museum-core'),
            'all_items'                  => __( 'All ' . $upperPlural, 'museum-core' ),
            'choose_from_most_used'      => __( 'Choose from the most used ' . $lowerPlural, 'museum-core' ),
            'edit_item'                  => __( 'Edit ' . $upperSingular, 'museum-core' ),
            'name'                       => __( $upperPlural, 'museum-core' ),
            'menu_name'                  => __( $upperPlural, 'museum-core' ),
            'new_item_name'              => __( 'New ' . $upperSingular . ' Name', 'museum-core' ),
            'not_found'                  => __( 'No ' . $lowerPlural . ' found.', 'museum-core' ),
            'parent_item'                => __( 'Parent ' . $upperSingular, 'museum-core' ),
            'parent_item_colon'          => __( 'Parent ' . $upperSingular . ':', 'museum-core' ),
            'popular_items'              => __( 'Popular ' . $upperPlural, 'museum-core' ),
            'search_items'               => __( 'Search ' . $upperPlural, 'museum-core' ),
            'separate_items_with_commas' => __( 'Separate ' . $lowerPlural . ' with commas', 'museum-core' ),
            'singular_name'              => __( $upperSingular, 'museum-core' ),
            'update_item'                => __( 'Update ' . $upperSingular, 'museum-core' ),
            'view_item'                  => __( 'View ' . $upperSingular, 'museum-core' )
        ];

        $this->args['label'] = $upperPlural;
        $this->args['labels'] = $labels;

        return $this;
    }

    /**
     * Get Existing Post Type
     *
     * @return \WP_Taxonomy|null
     */
    public function getExisting()
    {
        return $this->existing;
    }

    /**
     * Set the url slug used for rewrite rules
     *
     * @param string $slug
     *
     * @return Taxonomy $this
     */
    public function setSlug( $slug )
    {
        $this->args['rewrite'] = ['slug' => sanitize_title( $slug )];

        return $this;
    }
    
    /**
     * Set the resource
     *
     * @param array $resource
     *
     * @return Taxonomy $this
     */
    public function setResource( array $resource )
    {
        $this->resource = $resource;

        return $this;
    }

    /**
     * Get the form hook value by key
     *
     * @param string $key
     *
     * @return mixed
     */
    public function getForm( $key )
    {
        $form = null;
        if(array_key_exists($key, $this->form)) {
            $form = $this->form[$key];
        }

        return $form;
    }

    /**
     * Set the form main hook
     *
     * From hook to be added just above the title field
     *
     * @param bool|true|callable $value
     *
     * @return Taxonomy $this
     */
    public function setMainForm( $value = true )
    {
        if (is_callable( $value )) {
            $this->form['main'] = $value;
        } else {
            $this->form['main'] = true;
        }

        return $this;
    }

    /**
     * Set Hierarchical
     *
     * @param bool $bool
     *
     * @return Taxonomy $this
     */
    public function setHierarchical( $bool = true )
    {
        $this->args['hierarchical'] = (bool) $bool;

        return $this;
    }

    /**
     * Get the slug
     *
     * @return mixed
     */
    public function getSlug()
    {
        return $this->args['rewrite']['slug'];
    }

    /**
     * Register the taxonomy with WordPress
     *
     * @return Taxonomy $this
     */
    public function register()
    {
        if(!$this->existing) {
            $this->dieIfReserved();
        }

        do_action( 'tr_register_taxonomy_' . $this->id, $this );
        register_taxonomy( $this->id, $this->postTypes, $this->args );
        Registry::addTaxonomyResource($this->id, $this->resource);
        $this->attachHooks();

        return $this;
    }

    /**
     * Apply post types
     *
     * @param string|PostType $s
     *
     * @return Taxonomy $this
     */
    public function addPostType( $s )
    {

        if ($s instanceof PostType) {
            $s = $s->getId();
        } elseif (is_array( $s )) {
            foreach ($s as $n) {
                $this->addPostType( $n );
            }
        }

        if ( ! in_array( $s, $this->postTypes )) {
            $this->postTypes[] = $s;
        }

        return $this;

    }

    /**
     * Attach Hooks
     */
    public function attachHooks()
    {
        if(!$this->hooksAttached) {
            // Registry::taxonomyHooks($this);
            // $this->hooksAttached = true;
        }
    }

    /**
     * Add to WordPress permalinks so user can change it.
     */
    public function addToPermalinks() {
        add_action( 'load-options-permalink.php', [$this, 'load_permalinks'] );

        $key = 'museum_core_'.$this->id.'_base';

        if ( get_option( $key ) ) {
            $this->setSlug( get_option( $key ) );
        }

        return $this;
    }

    /**
     * Permalinks callback.
     * 
     * @return [type] [description]
     */
    public function load_permalinks() {
        $key = 'museum_core_'.$this->id.'_base';
        if( isset( $_POST[ $key ] ) ) {
            update_option( $key, sanitize_title_with_dashes( $_POST[ $key ] ) );
        }
        
        // Add a settings field to the permalink page
        add_settings_field( $key, sprintf(__( '%s Base', 'museum-core' ), $this->singular), [$this, 'permalink_callback'], 'permalink', 'optional' );
        
    }

    /**
     * Permalinks callback.
     * 
     * @return [type] [description]
     */
    public function permalink_callback()
    {
        $key = 'museum_core_'.$this->id.'_base';

        $value = get_option( $key );   
        $value = ($value) ? $value : $this->id; 
        $is_multi = is_multisite() ? '/blog' : '';

        echo $is_multi.'<input type="text" value="' . esc_attr( $value ) . '" name="'.$key.'" id="'.$key.'" class="regular-text" />';
    }
}
