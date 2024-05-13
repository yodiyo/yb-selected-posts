import { __ } from '@wordpress/i18n';
import { useState, useEffect } from '@wordpress/element';
import { useBlockProps, InspectorControls, RichText } from '@wordpress/block-editor';
import { PanelBody, ComboboxControl } from '@wordpress/components';
import { useEntityRecords } from '@wordpress/core-data';

export default function Edit( { attributes, setAttributes } ) {
	const [ selectedPost, setSelectedPost ] = useState( null );
	const [ searchText, setSearchText ] = useState( '' );

	// Fetch posts data using useEntityRecords hook
	const { records: searchResults = [], hasResolved, isResolving } = useEntityRecords(
		'postType',
		'post',
		{
			search: searchText,
			per_page: -1,
			status: 'publish',
		}
	);

	useEffect( () => {
		if ( ! hasResolved || isResolving ) {
			return;
		}

		// Set the default selected post as the first item from searchResults
		if ( selectedPost === null && attributes.selectedPost ) {
			const savedSelectedPost = searchResults.find( post => post.id === attributes.selectedPost.id );
			setSelectedPost(savedSelectedPost);
		}
	}, [ selectedPost, attributes.selectedPost, hasResolved, searchResults ] );

	const handleComboboxChange = ( newValue ) => {

		if ( isNaN( newValue) || newValue === null || ! searchResults ) {
			return;
		}

		// Find the selected post object from searchResults based on the selected post ID
		const selectedPostObject = searchResults.find( post => post.id === newValue );

		const { id, title: { rendered }, link } = selectedPostObject;
		setSelectedPost( { id, title: { rendered }, link } );
		setAttributes( { selectedPost: { id, title: { rendered }, link } } );
	};

	return (
		<div { ...useBlockProps() }>
			<InspectorControls>
				<PanelBody title={__('Block Settings')}>
					<ComboboxControl
						label = { __( 'Search Posts' ) }
						options = { searchResults ?
							searchResults.map( ( post ) => ( {
								value: post.id,
								label: post.title.rendered,
							} ) )
							:
							[]
						}
						onChange = { handleComboboxChange }
						onInputChange = { setSearchText }
						selected = { selectedPost ? selectedPost.id : '' }
						help = 'Select or search for post.'
					/>
				</PanelBody>
			</InspectorControls>
			<div { ...useBlockProps() }>
				{ selectedPost ?
					selectedPost.title && (
						<RichText.Content
						 tagName="p"
						 className="dmg-read-more"
						 value={ __('Read More: ') + selectedPost.title.rendered }
						 href={ selectedPost.link }
					 	/>
            		)
					:
					<p>{ __( 'Select or search for a published post in side panel.' ) }</p>
				}
			</div>

		</div>
	);
}

Edit.defaultProps = {
    attributes: {
        selectedPost: null, // Default value for selectedPost attribute
    },
};
